######## Webcam Object Detection Using Tensorflow-trained Classifier #########

# Import packages
import os
import cv2
import time
from datetime import date
from datetime import timedelta
import warnings
warnings.filterwarnings('ignore')

import numpy as np
import tensorflow as tf
import sys
import mysql.connector
import hashlib
from itertools import zip_longest

#Needed for file check
import os.path


# This is needed since the notebook is stored in the object_detection folder.
sys.path.append("..")

# Import utilites
from utils import label_map_util
from utils import visualization_utils as vis_util


from firebase import firebase
from firebase_admin import db


#Global variables to store session details
username=""
password=""


#Push data to Firebase
def push_to_firebase(item):
    # Fetch the service account key JSON file contents
    print("in push to firebase")
    from firebase import firebase
    # Get a database reference to our blog.
    firebase = firebase.FirebaseApplication('https://smart-fridge-1a173.firebaseio.com/', None)
    firebase.post('/fruit', item)
    print("out of push to firebase")


#Push data to MySql Database
def push_to_mysql(mysqlData):

    #print("Entered push")
    
    global username
    global password
    
    mydb = mysql.connector.connect(
        host="eu-cdbr-west-02.cleardb.net",
        user="b24bdb07f8df3b",
        passwd="98354db2",
        database="heroku_d0b67b039063502"
    )

    mycursor = mydb.cursor()
    
    #Delete from database all data at start
    deleteQuery="DELETE FROM items WHERE username = '"+username+"'"

    #print(deleteQuery)

    try:
        mycursor.execute(deleteQuery)
        mydb.commit()
    
    except:
        print("Initializing data pushing for first time!")

    #Insert the current data in to database
    insertQuery="INSERT INTO items (username, product, quantity, price, expiry) VALUES (%s, %s, %s, %s, %s)"
    for item in mysqlData:
        val = tuple(item)
        mycursor.execute(insertQuery, val)
    mydb.commit()


def login():

    global username
    global password
    
    mydb = mysql.connector.connect(
        host="eu-cdbr-west-02.cleardb.net",
        user="b24bdb07f8df3b",
        passwd="98354db2",
        database="heroku_d0b67b039063502"
    )

    mycursor = mydb.cursor()

    print("-----------------------------WELCOME TO REFRIGERG-----------------------------")

    savePassword()

    query="SELECT * FROM user WHERE username='"+username+"' AND password='"+password+"'"

    #print(query) #Debug step to verify query

    mycursor.execute(query)

    myresult = mycursor.fetchall()

    if(len(myresult)>0):
        return True
    return False


#Handles saving or input of login details
def savePassword():

    global username
    global password

    #Runs if login creds are already saved
    if os.path.isfile('pass.txt'):
        f=open('pass.txt',"r")
        username=f.readline().rstrip('\n')
        password=f.readline().rstrip('\n')
        f.close()

    #Runs if login creds arent saved
    else:
        print("Please enter your username:")
        username = input()
        print("Please enter your password:")
        password = input()
        encryptPassword = hashlib.md5(password.encode())
        password = encryptPassword.hexdigest()
        f = open("pass.txt","w+")
        f.write(username+"\n"+password)
        f.close()


def validLogin(): #Runs if user is present

    print("------------------------------------------------------------------------------")
    print()
    print()
    print("Succesfully Logged In.")
    print()
    print()
    print("------------------------------------------------------------------------------")


def invalidLogin(): #Runs if user is not present

    print("------------------------------------------------------------------------------")
    print()
    print()
    print("Login failed. This program will now exit.")
    print()
    print()
    print("------------------------------------------------------------------------------")


def classifierRunner(): #Runs after validLogin()

    global username
    global password
    
    print("------------------------------------------------------------------------------")
    print()
    print()
    print("Starting Refrigerg Core Functionalities....")
    print()
    print()
    print("------------------------------------------------------------------------------")


    # Name of the directory containing the object detection module we're using
    MODEL_NAME = 'inference_graph'

    # Grab path to current working directory
    CWD_PATH = os.getcwd()

    # Path to frozen detection graph .pb file, which contains the model that is used
    # for object detection.
    PATH_TO_CKPT = os.path.join(CWD_PATH,MODEL_NAME,'frozen_inference_graph.pb')

    # Path to label map file
    PATH_TO_LABELS = os.path.join(CWD_PATH,'training','labelmap.pbtxt')

    # Number of classes the object detector can identify
    NUM_CLASSES = 6

    ## Load the label map.
    # Label maps map indices to category names, so that when our convolution
    # network predicts `5`, we know that this corresponds to `king`.
    # Here we use internal utility functions, but anything that returns a
    # dictionary mapping integers to appropriate string labels would be fine
    label_map = label_map_util.load_labelmap(PATH_TO_LABELS)
    categories = label_map_util.convert_label_map_to_categories(label_map, max_num_classes=NUM_CLASSES, use_display_name=True)
    category_index = label_map_util.create_category_index(categories)

    # Load the Tensorflow model into memory.
    detection_graph = tf.Graph()
    with detection_graph.as_default():
        od_graph_def = tf.GraphDef()
        with tf.gfile.GFile(PATH_TO_CKPT, 'rb') as fid:
            serialized_graph = fid.read()
            od_graph_def.ParseFromString(serialized_graph)
            tf.import_graph_def(od_graph_def, name='')

        sess = tf.Session(graph=detection_graph)


    # Define input and output tensors (i.e. data) for the object detection classifier

    # Input tensor is the image
    image_tensor = detection_graph.get_tensor_by_name('image_tensor:0')

    # Output tensors are the detection boxes, scores, and classes
    # Each box represents a part of the image where a particular object was detected
    detection_boxes = detection_graph.get_tensor_by_name('detection_boxes:0')

    # Each score represents level of confidence for each of the objects.
    # The score is shown on the result image, together with the class label.
    detection_scores = detection_graph.get_tensor_by_name('detection_scores:0')
    detection_classes = detection_graph.get_tensor_by_name('detection_classes:0')

    # Number of objects detected
    num_detections = detection_graph.get_tensor_by_name('num_detections:0')

    # Initialize webcam feed
    #video = cv2.VideoCapture(0)
    #ret = video.set(3,1280)
    #ret = video.set(4,720)
    
    #Map Id to Fruit Name
    mp = {1.0 : 'pineapple', 2.0 : 'banana', 3.0 : 'brinjal', 4.0 : 'cauliflower', 5.0 : 'capsicum', 6.0 : 'bottle'}

    price = {'pineapple': 2 ,'banana': 3 ,'brinjal': 4 ,'cauliflower': 5 ,'capsicum': 6 , 'fanta': 7 }

    #Set expiry date
    EXPY = {'banana' : 3, 'cauliflower' : 3, 'brinjal' : 3, 'pineapple' : 3, 'bottle' : 10, 'capsicum' : 3}

    while(True):

        time.sleep(3)

        print("Capturing Image..")
        cap = cv2.VideoCapture(0)
        ret, frame = cap.read()

        
        # Acquire frame and expand frame dimensions to have shape: [1, None, None, 3]
        # i.e. a single-column array, where each item in the column has the pixel RGB value
        #ret, frame = video.read()
        frame_rgb = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
        frame_expanded = np.expand_dims(frame_rgb, axis=0)

        # Perform the actual detection by running the model with the image as input
        (boxes, scores, classes, num) = sess.run(
            [detection_boxes, detection_scores, detection_classes, num_detections],
            feed_dict={image_tensor: frame_expanded})
        lstClasses = classes.tolist()
        lstClasses = [item for my_list in zip_longest(*lstClasses) 
                           for item in my_list if item] 
        lstScores = scores.tolist()
        lstScores = [item for my_list in zip_longest(*lstScores) 
                           for item in my_list if item]
        #lstNum = num.tolist()
        #print("Classes-----",len(lstClasses))
        #print(lstClasses)
        #print("Scores-----",len(lstScores))
        #print(lstScores)
        #print("Nums-----")
        #print(lstNum)
        
        items = {}
        n = 300
        for i in range(n):
            if lstScores[i] > 0.400:
                if mp[lstClasses[i]] not in items.keys():
                    items[mp[lstClasses[i]]]=1
                else:
                    items[mp[lstClasses[i]]]+=1
                    
        print(items)

        #Push Data to Database
        today = date.today() # Why is this here?

        mysqlData = []

        for tm in items:
            temp = {}
            mysqlTemp=[]
            val = tm
            if(val == 'bottle'):
                val = 'fanta'

            mysqlTemp.append(username)

            temp['name'] = val
            mysqlTemp.append(val)

            temp['count'] = items[tm]
            mysqlTemp.append(items[tm])

            mysqlTemp.append(price[val])

            temp['expiry'] = str(date.today() + timedelta(days=EXPY[tm]))
            mysqlTemp.append(str(date.today() + timedelta(days=EXPY[tm])))

            print(temp)
            #print(mysqlTemp)

            push_to_firebase(temp)
            mysqlData.append(mysqlTemp)

        push_to_mysql(mysqlData)

        
                
        
        
        # Draw the results of the detection (aka 'visulaize the results')
        #vis_util.visualize_boxes_and_labels_on_image_array(
            #frame,
            #np.squeeze(boxes),
            #np.squeeze(classes).astype(np.int32),
            #np.squeeze(scores),
            #category_index,
            #use_normalized_coordinates=True,
            #line_thickness=8,
            #min_score_thresh=0.50)

        # All the results have been drawn on the frame, so it's time to display it.
        #cv2.imshow('Object detector', frame)

        # Press 'q' to quit
        if cv2.waitKey(1) == ord('q'):
            break

    # Clean up
    video.release()
    cv2.destroyAllWindows()

if __name__ == "__main__":
    print() #prints blank line for dist
    if(login()):
        validLogin()
        classifierRunner()
    else:
        invalidLogin()
    


