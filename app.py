import logging
logging.basicConfig(filename='app.log', level=logging.ERROR)
from flask import Flask
from flask import Flask, request, jsonify, render_template
import os
from os.path import join
# import pymysql
import json
import pymysql


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


#registering new visitor
@app.route('/register', methods = ['POST'])
def register():

	uid = request.form["id"]
	img = request.form["img_name"]
	
	img_path = os.path.join("DeepBlue\\upload\\visitor",img)
	
	result = obj.register_img(uid,img_path)

	return jsonify({"result":result[0],"message":result[1]})
	

#updating image of visitor (Generating new emb and removing the previous one)
@app.route('/update', methods = ['POST'])
def update():

	uid = request.form["id"]
	img = request.form["img_name"]
	
	img_path = os.path.join("DeepBlue\\upload\\visitor",img)
	
	result = obj.update_img(uid,img_path)

	return jsonify({"result":result[0],"message":result[1]})
	


#deleting a visitor
@app.route('/delete', methods = ['POST'])
def delete():

	uid = request.form["id"]
	
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
	

	

	result = obj.get_id(rpi_image)
	print(result)

	# filelist = [ f for f in os.listdir(os.path.join(app.config['UPLOAD_FOLDER']))]
	# #code to remove the mp4 file below 2 lines
	# for i in filelist:
	# 	os.remove(os.path.join(app.config['UPLOAD_FOLDER'], i))
	id=result[0]
	status ="unread"
	data=(id,temp,status)
	# status ="unread"
	insert1 = "INSERT INTO dailyvisit(id, temp,status) VALUES (%s,%s,%s);"

	
	#executing the quires
	cursor.execute(insert1,data)
	
	#commiting the connection then closing it.

	connection.commit()
	connection.close()

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
