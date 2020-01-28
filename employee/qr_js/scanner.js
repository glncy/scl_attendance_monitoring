//--------------------
// GET USER MEDIA CODE
//--------------------
navigator.getUserMedia = ( navigator.getUserMedia ||
                   navigator.webkitGetUserMedia ||
                   navigator.mozGetUserMedia ||
                   navigator.msGetUserMedia);
var video;
var webcamStream;

var gCtx = null;
var gCanvas = null;
var c=0;
var stype=0;
var gUM=false;
var webkit=false;
var moz=false;
var v=null;


function load()
{
	initCanvas(800, 600);
	//qrcode.callback = read;
	if (navigator.getUserMedia) {
    	navigator.getUserMedia (
        	// constraints
        	{
            	video: true,
            	audio: false
          	},

        	// successCallback
        	function(localMediaStream) {
            	video = document.querySelector('video');
           		video.src = window.URL.createObjectURL(localMediaStream);
             	webcamStream = localMediaStream;
             	setTimeout(captureToCanvas, 500); 
          	},

          	// errorCallback
          	function(err) {
            	console.log("The following error occured: " + err);
          	});
    }
  	else {
    	console.log("getUserMedia not supported");
  	}  
}

function initCanvas(w,h)
{
  	gCanvas = document.getElementById("qr-canvas");
  	gCanvas.style.width = w + "px";
  	gCanvas.style.height = h + "px";
  	gCanvas.width = w;
  	gCanvas.height = h;
  	gCtx = gCanvas.getContext("2d");
  	gCtx.clearRect(0, 0, w, h);
}

function captureToCanvas()
{
	try{
		gCtx.drawImage(video, 0,0, gCanvas.width, gCanvas.height);
    	try{
        	var qr_pw = qrcode.decode();
          if (modetime=="timein") {
            if (pw==qr_pw)
            {
              var getID = document.getElementById('id').value;
              alert("Timed in!");
              window.location.href = 'timestamp.php?id='+getID+'&mode=timein';
            }
            else
            {
              alert("Invalid QR Code.");
              load();
            }
          }
          else if (modetime=="timeout") {
            if (pw==qr_pw)
            {
              var ref_id = document.getElementById('reference').value;
              var gettimeid = document.getElementById('timeid').value;
              
              alert("Timed Out!");
              window.location.href = 'timestamp.php?id='+gettimeid+'&mode=timeout&ref='+ref_id;
            }
            else
            {
              alert("Invalid QR Code.");
              load();
            }
          }
        	else if (modetime=="login") {
            if (pw==qr_pw)
            {
              var getID = document.getElementById('id').value;
              
              alert("Login!");
              window.location.href = 'login.php?id='+getID+'&pw='+qr_pw;
            }
            else
            {
              alert("Invalid QR Code.");
              load();
            }
          }
      	}
      	catch(e){       
        	console.log(e);
        	setTimeout(captureToCanvas, 500);
      	};
  	}
  	catch(e){       
        console.log(e);
        setTimeout(captureToCanvas, 500);
  	};
}