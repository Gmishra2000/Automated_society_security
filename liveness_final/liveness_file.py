# import the necessary packages
import os
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3'
from tensorflow.keras.preprocessing.image import img_to_array
from tensorflow.keras.models import load_model
import numpy as np
import imutils
import pickle
import time
import cv2
# import pandas as pd
# from flask import Flask
# from flask import Flask, request, jsonify, render_template
from os.path import join
# import json

#### import for error handling ####
# from werkzeug.exceptions import HTTPException

#### import for logging error #####
# import logging
# from flask.logging import default_handler



# ALLOWED_EXTENSIONS = set(['mp4','h264'])
# UPLOAD_FOLDER = join(os.getcwd(),'static','uploads') 
# application = Flask(__name__)
# application.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER
# application.config['MAX_CONTENT_LENGTH'] = 100 * 1024 * 1024 # max upload - 10MB

#creating app.log
#### logging config ####
# application.logger.removeHandler(default_handler)
# log_path = join(os.getcwd(), 'app.log')
# logging.basicConfig(filename=log_path, level=logging.ERROR,format='%(asctime)s: %(message)s')


# load our serialized face detector from disk
print("[INFO] loading face detector...")
protoPath = os.path.sep.join(["liveness_final/face_detector", "deploy.prototxt"])
modelPath = os.path.sep.join(["liveness_final/face_detector",
	"res10_300x300_ssd_iter_140000.caffemodel"])
net = cv2.dnn.readNetFromCaffe(protoPath, modelPath)

# load the liveness detector model and label encoder from disk
print("[INFO] loading liveness detector...")
model = load_model("liveness_final/liveness.model")
le = pickle.loads(open("liveness_final/le.pickle", "rb").read())

# initialize the video stream and allow the camera sensor to warmup
print("[INFO] starting video stream...")
expected = 'real'


# #### error handlers ####
# #http exceptions handler
# @application.errorhandler(HTTPException)
# def handle_exception(e):
# 	"""Return JSON instead of HTML for HTTP errors."""
# 	# start with the correct headers and status code from the error
# 	response = e.get_response()
# 	# replace the body with JSON
# 	response.data = json.dumps({
# 			"code": e.code,
# 			"name": e.name,
# 			"description": e.description,
# 	})
# 	response.content_type = "application/json"

# 	logging.error('########### ' + str(e) + ' ###########', exc_info=True)

# 	return response

# #other exceptions handler -> comment this one to see errors on console
# @application.errorhandler(Exception)
# def handle_exception(e):
# 	# pass through HTTP errors
# 	if isinstance(e, HTTPException):
# 			return e

# 	err = {
# 			"code": -1,
# 			"name": "Server Error",
# 			"description": "Unexpected Error. Please contact Admin"
# 	}

# 	logging.error('########### ' + str(e) + ' ###########', exc_info=True)

# 	# now you're handling non-HTTP exceptions only
# 	return jsonify(err)



# @application.route("/liveness",methods=['POST'])
def liveness_check(vid_path):	
	
	# files = request.files.getlist('files[]')
	
	# if files[0].filename == '':
	# 	return jsonify({'result':'video file not found'})
	
	# for file in files:
	# 	filename = file.filename
	# 	file.save(os.path.join(application.config['UPLOAD_FOLDER'], filename))

	# logging.error("File Found, Processing...")
	
	# vs = cv2.VideoCapture(os.path.join(application.config['UPLOAD_FOLDER'], filename))
	vs = cv2.VideoCapture(vid_path)
	frame_count = int(vs.get(cv2.CAP_PROP_FRAME_COUNT))
	
	
	if frame_count > 25:
		skip_frame = frame_count // 25
	else:
		skip_frame = 1
	real = 0
	fake = 0
	real_val = []
	fake_val = []
	# rotation logic
	rotate_by = None
	keep_og = True
	counter = -1
	
	
	real_count=0
	fake_count=0
	while True:
		
		ret, frame = vs.read()
		counter += 1

		if not ret:
			break

		if counter % skip_frame != 0:
			continue

		if not keep_og:
			frame = cv2.rotate(frame, rotate_by)

		frame = imutils.resize(frame, width=600)
		(h, w) = frame.shape[:2]
		blob = cv2.dnn.blobFromImage(cv2.resize(frame, (300, 300)), 1.0,
			(300, 300), (104.0, 177.0, 123.0))

		net.setInput(blob)
		detections = net.forward()

		# for i in range(0, detections.shape[2]):
		i = np.argmax(detections[0, 0, :, 2])
		confidence = detections[0, 0, i, 2]
		if confidence > 0.8:
			box = detections[0, 0, i, 3:7] * np.array([w, h, w, h])
			(startX, startY, endX, endY) = box.astype("int")
			startX = max(0, startX)
			startY = max(0, startY)
			endX = min(w, endX)
			endY = min(h, endY)
			face = frame[startY:endY, startX:endX]
			if face.shape[0] == 0 or face.shape[1] == 0:
				continue
			face = cv2.resize(face, (32, 32))
			face = face.astype("float") / 255.0
			face = img_to_array(face)
			face = np.expand_dims(face, axis=0)
			preds = model.predict(face)[0]
			real_val.append(preds[1])
			fake_val.append(preds[0])
			j = np.argmax(preds)
			label = le.classes_[j]

			color = (0, 0, 255)
			if label == 'real':
				real_count+=1
				print(preds[j])
				real += round(preds[j], 4)
				color = (0, 255, 0)
			elif label == 'fake':
				fake_count+=1
				print(preds[j])
				fake += round(preds[j], 4)
				color = (0, 0, 255)
	vs.release()

	
	print("done")
	s=(real_count+1) / (fake_count+1)
	s=round(s,3)
	return s
	# if s>10:
	# 	predicted="live"
	# 	return jsonify({"result":"live","value":s})
	# else:
	# 	predicted="No"
	# 	return jsonify({"result":"fake","value":s})
	
		



	
	

# if __name__ == "__main__":
# 	application.run(debug=True, port = 5002)




	