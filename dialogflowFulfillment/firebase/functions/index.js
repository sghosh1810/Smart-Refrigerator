'use strict';
 
const functions = require('firebase-functions');
const admin = require('firebase-admin');
const {WebhookClient} = require('dialogflow-fulfillment');
const {Card, Suggestion} = require('dialogflow-fulfillment');
 
process.env.DEBUG = 'dialogflow:debug'; // enables lib debugging statements
admin.initializeApp({
  credential: admin.credential.applicationDefault(),
  databaseURL: 'https://smartref-c644d.firebaseio.com/', //https://smartref-c644d.firebaseio.com/
});
const db = admin.database();
 
exports.dialogflowFirebaseFulfillment = functions.https.onRequest((request, response) => {
  const agent = new WebhookClient({ request, response });
  console.log('Dialogflow Request headers: ' + JSON.stringify(request.headers));
  console.log('Dialogflow Request body: ' + JSON.stringify(request.body));
 
  function welcome(agent) {
    agent.add(`Welcome to my agent!`);
  }
 
  function fallback(agent) {
    agent.add(`I didn't understand`);
    agent.add(`I'm sorry, can you try again?`);
  }
 function test(agent) {
    agent.add(`testing`);
  }
  
  function listItems (agent) {
    var a = 0;
    var b = 0;
    var c = 0;
    var d = 0;
    var e = 0;
    var ref = db.ref("/fruit/");
    return ref.once("value", function(snapshot) {
      var returnVal = [];
      var res = snapshot.val();
      console.log("After res");
      console.log(res);
      for(var key in res){
        var doc = res[key];
        console.log(doc.name);
        if(doc.name === "apple") {
        a = 1;
        }
        if(doc.name === "banana") {
        b = 1;
        }
        if(doc.name === "pineapple") {
        c = 1;
        }
        if(doc.name === "fanta") {
        d = 1;
        }
       
      }    
      if(a === 1){
        returnVal.push("Apple, ");
        }
        if(b === 1){
        returnVal.push("Banana, ");
        }
        if(c === 1){
        returnVal.push("Pineapple, ");
        }
        if(d === 1){
        returnVal.push("Fanta, ");
        }
      if(returnVal.length === 0){
        agent.add("There are no items in fridge");
      }else{
        agent.add("Currently, the fridge contains " + returnVal.join(","));
      }
      return Promise.resolve('Read complete');
    }, function (errorObject) {
      agent.add('Error reading entry from the Firestore database.');
      console.log("The read failed: " + errorObject.code);
    });    
  }
 
  function expItems (agent) {
    var a = 0;
    var b = 0;
    var c = 0;
    var d = 0;
    var e = 0;
    var ref = db.ref("/fruit/");
    return ref.once("value", function(snapshot) {
      var returnVal = [];
      var res = snapshot.val();
      console.log("After res");
      console.log(res);
      var cd = 11;
      var cm = 4;
      var cy = 2020;
      for(var key in res){
        var doc = res[key];
        console.log(doc.name);
        var str = doc.expiry;
        var arr = str.split('-');
        var myd = parseInt(arr[2], 10);
        var mymn = parseInt(arr[1], 10);
        var myyr = parseInt(arr[0], 10);
       
        if(myd - cd < 1){
        if(doc.name === "apple") {
        a = 1;
        }
        if(doc.name === "banana") {
        b = 1;
        }
        if(doc.name === "pineapple") {
        c = 1;
        }
        if(doc.name === "fanta") {
        d = 1;
        }
        }
      }    
      if(a === 1){
        returnVal.push("Apple, ");
        }
        if(b === 1){
        returnVal.push("Banana, ");
        }
        if(c === 1){
        returnVal.push("Pineapple, ");
        }
        if(d === 1){
        returnVal.push("Fanta, ");
        }
      agent.add("The items going to be expired are: " + returnVal.join(","));
 
      return Promise.resolve('Read complete');
    }, function (errorObject) {
      agent.add('Error reading entry from the Firestore database.');
      console.log("The read failed: " + errorObject.code);
    });    
  }
 
 
  function listApple (agent) {

    var ref = db.ref("/fruit/");
    return ref.once("value", function(snapshot) {
      var returnVal = 0;
      var res = snapshot.val();
      console.log("After res");
      console.log(res);
      for(var key in res){
        var doc = res[key];
        console.log(doc.name);
        if(doc.name === "apple") {
          returnVal += doc.count;
        }
      }      
      agent.add("Currently, the fridge contains " + returnVal + " apples");
      return Promise.resolve('Read complete');
    }, function (errorObject) {
      agent.add('Error reading entry from the Firestore database.');
      console.log("The read failed: " + errorObject.code);
    });    
  }
  function listPine (agent) {
   
    var ref = db.ref("/fruit/");
    return ref.once("value", function(snapshot) {
      var returnVal = 0;
      var res = snapshot.val();
      console.log("After res");
      console.log(res);
      for(var key in res){
        var doc = res[key];
        console.log(doc.name);
        if(doc.name === "pineapple") {
        returnVal += doc.count;
        }
      }      
      agent.add("Currently, the fridge contains " + returnVal + " pineapples");
      return Promise.resolve('Read complete');
    }, function (errorObject) {
      agent.add('Error reading entry from the Firestore database.');
      console.log("The read failed: " + errorObject.code);
    });    
  }
  function listBanana (agent) {
   
    var ref = db.ref("/fruit/");
    return ref.once("value", function(snapshot) {
      var returnVal = 0;
      var res = snapshot.val();
      console.log("After res");
      console.log(res);
      for(var key in res){
        var doc = res[key];
        console.log(doc.name);
        if(doc.name === "banana") {
        returnVal += doc.count;
        }
      }      
      agent.add("Currently, the fridge contains " + returnVal + " bananas");
      return Promise.resolve('Read complete');
    }, function (errorObject) {
      agent.add('Error reading entry from the Firestore database.');
      console.log("The read failed: " + errorObject.code);
    });    
  }
  function listFanta (agent) {
   
    var ref = db.ref("/fruit/");
    return ref.once("value", function(snapshot) {
      var returnVal = 0;
      var res = snapshot.val();
      console.log("After res");
      console.log(res);
      for(var key in res){
        var doc = res[key];
        console.log(doc.name);
        if (doc.name === "fanta") {
        returnVal += doc.count;
        }
      }      
      agent.add("Currently, the fridge contains " + returnVal + " fantas");
      return Promise.resolve('Read complete');
    }, function (errorObject) {
      agent.add('Error reading entry from the Firestore database.');
      console.log("The read failed: " + errorObject.code);
    });    
  }

  // Run the proper function handler based on the matched Dialogflow intent name
  let intentMap = new Map();
  intentMap.set('Default Welcome Intent', welcome);
  intentMap.set('Default Fallback Intent', fallback);
  intentMap.set('content list', listItems);
  intentMap.set('count apple', test);
  intentMap.set('count pineapple', listPine);
  intentMap.set('count banana', listBanana);
  intentMap.set('count fanta', listFanta);
  intentMap.set('expiry', expItems);
  agent.handleRequest(intentMap);
});