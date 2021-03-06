import logging
logging.basicConfig(filename='app.log', level=logging.ERROR)
from flask import Flask
from flask import Flask, request, jsonify, render_template
# import liveness_final
from liveness_final.liveness_file import *
# from liveness_file import *
import os
from os.path import join
# import pymysql
import json
import pymysql
import requests
import cv2


from face_emb import FaceRecognition
obj=FaceRecognition('numpy/emb.npy','numpy/id.npy')


#### import for error handling ####
from werkzeug.exceptions import HTTPException
# from werkzeug.utils import secure_filename

#### import for logging error #####
from flask.logging import default_handler

app = Flask(__name__)
UPLOAD_FOLDER = join(os.getcwd(),'static','uploads')
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER

#### logging config ####
app.logger.removeHandler(default_handler)

#### error handlers ####
#http exceptions handler
@app.errorhandler(HTTPException)
def handle_exception(e):
	"""Return JSON instead of HTML for HTTP errors."""
	# start with the correct headers and status code from the error
	response = e.get_response()
	# replace the body with JSON
	response.data = json.dumps({
			"code": e.code,
			"name": e.name,
			"description": e.description,
	})
	response.content_type = "application/json"

	logging.error('########### ' + str(e) + ' ###########', exc_info=True)

	return response

#other exceptions handler -> comment this one to see errors on console
@app.errorhandler(Exception)
def handle_exception(e):
	# pass through HTTP errors
	if isinstance(e, HTTPException):
			return e
	err = {
			"code": -1,
			"name": "Server Error",
			"description": "Unexpected Error. Please contact Admin"
	}

	logging.error('########### ' + str(e) + ' ###########', exc_info=True)

	# now you're handling non-HTTP exceptions only
	return jsonify(err)

#### end of error handlers ####

@app.route('/liveness', methods = ['POST'])
def liveness():

	files = request.files.getlist('files[]')
	
	if files[0].filename == '':
		return jsonify({'result':'video file not found'})
	
	for file in files:
		filename = file.filename
		file.save(os.path.join(app.config['UPLOAD_FOLDER'], filename))

	
	score = liveness_check(os.path.join(app.config['UPLOAD_FOLDER'], filename))
	if score>10:
		return jsonify({"result":"live","value":score})
	else:
		return jsonify({"result":"fake","value":score})


	



	# uid = request.form["id"]
	# img = request.form["img_name"]
	
	# img_path = os.path.join("DeepBlue\\upload\\visitor",img)
	
	# result = obj.register_img(uid,img_path)

	# return jsonify({"result":result[0],"message":result[1]})


#registering new visitor
@app.route('/register', methods = ['POST'])
def register():

	uid = int(request.form['id'])
	# houseno = request.form['houseno']
	# aadhar = request.form['aadhar']
	# phone = request.form['phone']
	# designation = request.form['designation']
	img_file = request.files['img_name']


	print(uid)
	filename = img_file.filename
	print(img_file)
	filename = filename.split("/")[-1]

	# img = request.form["img_name"]
	# img_path = "DeepBlue/visitor_images_dummy/" + img
	# for file in img_file:
	# 	filename = file.filename
	# 	print(filename)


	
	# print(img_file)
	print("**********")
	# filename = img_file.filename
	print(filename)
	print("**********")

	# print(filename.filename)
	img_file.save(os.path.join(app.config['UPLOAD_FOLDER'], filename))

	
	# print(img_path)
	# print(uid)
	# img = cv2.imread(img_path)
	# cv2.imshow('ImageWindow', img)
	# cv2.waitKey()
	
	img_path = os.path.join(app.config['UPLOAD_FOLDER'], filename)
	result = obj.register_img(uid,img_path)
	# print(result)

	return jsonify({"result":result[0],"message":result[1]})
	

#updating image of visitor (Generating new emb and removing the previous one)
@app.route('/update', methods = ['POST'])
def update():

	
	img_file = request.files['img_name']
	uid = int(request.form['id'])

	# print(uid)
	filename = img_file.filename
	# print(img_file)
	filename = filename.split("/")[-1]

	img_file.save(os.path.join(app.config['UPLOAD_FOLDER'], filename))

	img_path = os.path.join(app.config['UPLOAD_FOLDER'], filename)
	
	# img_path = os.path.join("DeepBlue\\upload\\visitor",img)
	# print(img_file)
	print("**********")
	print(uid,type(uid))
	# filename = img_file.filename
	print(filename)
	print(img_path)
	print("**********")

	

	
	result = obj.update_img(uid,img_path)
	print(result[0])
	print(result[1])
	return jsonify({"result":result[0],"message":result[1]})
	


#deleting a visitor
@app.route('/delete', methods = ['POST'])
def delete():

	uid = int(request.form["id"])
	
	result = obj.delete_embedding(uid)

	return jsonify({"result":result[0],"message":result[1]})


#face recognition from rpi
@app.route('/recognize', methods = ['POST'])
def recognize():
	connection = pymysql.connect(host="localhost",port=3306,user="root",password='',database="adminpanel" )
	cursor = connection.cursor()

	file = request.files['file']
	temp = request.form["temp"]
	
	#Saving the image file in folder
	file.save(os.path.join(app.config['UPLOAD_FOLDER'], file.filename))
	
	rpi_image=os.path.join(app.config['UPLOAD_FOLDER'], file.filename)
	# print(type(temp))

	

	result = obj.get_id(rpi_image)
	# print(result)

	# filelist = [ f for f in os.listdir(os.path.join(app.config['UPLOAD_FOLDER']))]
	# #code to remove the mp4 file below 2 lines
	# for i in filelist:
	# 	os.remove(os.path.join(app.config['UPLOAD_FOLDER'], i))
	id=result[1]
	# print(type(id))
	status ="unread"
	data=(id,temp,status)
	# status ="unread"
	# if result[]

	# Check here the if else condition
	insert1 = "INSERT INTO dailyvisit(id, temp,status) VALUES (%s,%s,%s);"


	# select1 = "SELECT Name FROM visitor WHERE id = ?"

	
	#executing the quires
	cursor.execute(insert1,data)


	# cursor.execute("SELECT Name FROM visitor WHERE id = %d" % int(id))

	# myresult = cursor.fetchall()
	# name = myresult[0][0]
	# # print(name)
	# # print(type(name))

	# # for x in myresult:
	# # 	print(x)
	# # 	print(type(x))
	
	# #commiting the connection then closing it.

	connection.commit()
	connection.close()

	# url = "http://localhost/Automated_Security_System/testingapi.php"
	# print(id)
	# print(name)
	# print(temp)

	# # payload="{\"id\":\id,\r\n\"name\":\name,\r\n\"temp\":\temp\r\n}"
	# payload={"id":id,"name":name,"temp":temp}
	# headers = {
	# 'Content-Type': 'application/json'
	# }

	# response = requests.request("POST", url, headers=headers, data=json.dumps(payload))
	# print(response)

	# print(response.text)


	return jsonify({"result":result[0],"message":result[1]})
	

	
	
	
	
	
	
	
	
	
	# connection = pymysql.connect(host="localhost",port=3307,user="root",password='',database="adminpanel" )
	# cursor = connection.cursor()
	#################################################################
	# files = request.files.getlist('files[]')
	# if len(files)==0:
	# 	return jsonify({"message":"File not recieved"})

	








	# if text == '':
	# 	return jsonify({"message" : "No value for text parameter provided"})
	##################################################################
	# for file in files:
	# 	if allowed_extensions(file.filename) == False:
	# 		return jsonify({'message': "Wrong file format"})
	# for file in files:
	# 	# filename = secure_filename(file.filename)
	# 	file.save(os.path.join(app.config['UPLOAD_FOLDER'], file.filename))
	#Calling pipeline function to calculate similarity
	# value_text, catch = pipeline(os.path.join(app.config['UPLOAD_FOLDER'], filename), text)
	# filelist = [ f for f in os.listdir(os.path.join(app.config['UPLOAD_FOLDER']))]
# 	c=0
# 	vis_path=os.path.join(os.getcwd(),"DeepBlue\\upload\\visitor")
# 	# visitorlist=os.listdir(vis_path)
# 	face_recognised=False
# 	for i in os.listdir(vis_path):
# 		c+=1
# 		rpi_image=os.path.join(app.config['UPLOAD_FOLDER'], file.filename)
# 		visitor_image=os.path.join(vis_path,i)
# 		result  = DeepFace.verify(rpi_image,visitor_image,model_name='Facenet')
# 		print("Is verified: ", result["verified"])
# 		#results = DeepFace.verify([['img1.jpg', 'img2.jpg'], ['img1.jpg', 'img3.jpg']])
# 		if result["verified"]:
			
# 			face_recognised=result["verified"]
# 			break
	
# 	id=c
# 	data=(id,temp)
# 	insert1 = "INSERT INTO dailyvisit(id, temp) VALUES (%s,%s);"

	
# 	#executing the quires
# 	cursor.execute(insert1,data)
	
# 	#commiting the connection then closing it.

# 	connection.commit()
# 	connection.close()

# 	return jsonify({"message":"Processed Successfully","Result":face_recognised,"id":id})
	
	



if __name__ == "__main__":
	app.run(debug=True, port = 5005)
# # id=1
# # temp=95.21
# # data=(id,temp)
# # insert1 = "INSERT INTO dailyvisit(id, temp) VALUES (%s,%s);"

# # #executing the quires
# # cursor.execute(insert1,data)

# # #commiting the connection then closing it.
# # connection.commit()
# # connection.close()
