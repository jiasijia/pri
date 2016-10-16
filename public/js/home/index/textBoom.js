(function(){
  window.requestAnimationFrame = (function(){
  	return  window.requestAnimationFrame       ||
          	window.webkitRequestAnimationFrame ||
          	window.mozRequestAnimationFrame    ||
          	function( callback ){
            	window.setTimeout(callback, 1000 / 60);
          	};
  })();
  window.cancelAnimationFrame = (function () {
    return window.cancelAnimationFrame ||
           window.webkitCancelAnimationFrame ||
           window.mozCancelAnimationFrame ||
           window.oCancelAnimationFrame ||
           function (id) {
               window.clearTimeout(id);
           };
  })();

  var stats = new Stats();
      stats.setMode(0);
      stats.domElement.style.position = 'absolute';
      stats.domElement.style.right = '0px';
      stats.domElement.style.top = '0px';
      document.body.appendChild( stats.domElement );

  var canvas = document.querySelector('#c');
      ctx = canvas.getContext('2d');
      canvas.width = width = window.innerWidth;
      canvas.height = height = window.innerHeight;

  var handle,
  	  thisTime,
  	  lastTime,
  	  particles = [],
      focalLength = 250,				/*焦距*/
      speed = 0.2,						/*粒子运动速度*/
      devScale = width < 500 ? 0.4 : 1, /*设备缩放率*/
      density = 5, 						/*取样密度*/
      interval = 3000,					/*间隔/ms*/
      text = [
      	'锄禾日当午',
      	'汗滴禾下土',
      	'谁知盘中餐',
      	'粒粒皆辛苦'
      ];


  function getImageData(){
    //drawText();
    particles = [];
    var imageData = ctx.getImageData(0, 0, width, height);
    ctx.clearRect(0, 0, width, height);
    for (var x = 0; x < imageData.width; x+=Math.floor(density * devScale)) {
      for(var y = 0; y < imageData.height; y+=Math.floor(density * devScale)) {
        var i = (y * imageData.width + x) * 4;
        if (imageData.data[i+3] > 128) {
          var p = new particle(x, y, 0, 2 * devScale);
          particles.push(p);
        }
      }
    }
  }

  function init() {
    for (var i in particles) {
      var p = particles[i];
      p.tx = Math.random() * width;
      p.ty = Math.random() * height;
      p.tz = Math.random() * focalLength * 2 - focalLength;
      p.x = Math.random() * width;
      p.y = Math.random() * height;
      p.z = Math.random() * focalLength * 2 - focalLength;
    }
  }

  function particle(x, y, z, r){
    /*最初位置*/
    this.dx = x;
    this.dy = y;
    this.dz = z;
    
    /*最终位置*/
    this.tx = 0;
    this.ty = 0;
    this.tz = 0;

    /*实时位置*/
    this.x = 0;
    this.y = 0;
    this.z = 0;

    this.r = r;
    this.f = '';

    this.cacheCanvas = document.createElement('canvas');
    this.cacheCtx = this.cacheCanvas.getContext('2d');
    this.cacheCanvas.Width = 10;
    this.cacheCanvas.Height = 10;
    this.useCache = false;
    if (this.useCache) {
      this.cache();
    }
  }

  particle.prototype = {
    paint: function()
    {
      if (!this.useCache) {
        ctx.save();
        var scale = focalLength / (focalLength + this.z);

        ctx.beginPath();
        //ctx.shadowColor = this.f != false ? 'red' : '';
    	  //ctx.shadowBlur = this.f != false ? '10' : '';
        ctx.fillStyle = this.f || '#000';
        ctx.arc(width/2 + (this.x - width/2) * scale, height/2 + (this.y - height/2) * scale, this.r * scale, 0, 2 * Math.PI);
        ctx.fill();
        ctx.restore();
      }
      else {
        ctx.drawImage(this.cacheCanvas, this.x - this.cacheCanvas.Width / 2, this.y - this.cacheCanvas.Height / 2);
      }
    },

    cache: function(){
      var ctx = this.cacheCtx;
      var scale = focalLength / (focalLength + this.z);
      ctx.save();
      ctx.beginPath();
      ctx.fillStyle = this.f || '#000';
      ctx.arc(width/2 + (this.x - width/2) * scale, height/2 + (this.y - height/2) * scale, this.r * scale, 0, 2 * Math.PI);
      ctx.fill();
      ctx.restore();
    }
  }

  function getRandomColor() {
  	return '#' + (Math.random() * 0xffffff << 0).toString(16);
  }

  function drawText(text) {
    //ctx.save()
    ctx.clearRect(0, 0, width, height);
    ctx.font = 'bold ' + (130 * devScale) + 'px Arial';
    ctx.fillStyle = 'rgba(168, 168, 168, 1)';
    ctx.textAlign = 'center';
    ctx.textBaseLine = 'middle';
    ctx.fillText(text, width/2, height/2)
    ctx.fill();
    //ctx.restore();
  }

  function exec() {

  	var i = 1;
  	action(text[0]);
  	setTimeout(function(){
  	  var s = setInterval(function(){
  		action(text[i]);

  		i++;
  		if (i > text.length - 1) {
  			clearInterval(s);
  		}
  	  }, interval);
  	}, 2000);
  	
  }
  
  function action(t) {
  	drawText(t);
  	getImageData();
  	init();
  	animate(interval);
  }

  function animate(interval) {
  	var drift = false; /*游离*/
  	var pause = false;
  	var start = new Date();
  	var end;
  	var num = 0;
  	handle = requestAnimationFrame(loop = function(){
	    ctx.clearRect(0, 0, width, height);

	    for (var i in particles) {
	      var p = particles[i];

	      p.paint();
	      if (drift === true){
	        if (Math.abs(p.x - p.dx) < 0.1 && Math.abs(p.y - p.dy) < 0.1) {
	          p.x = p.dx;
	          p.y = p.dy;
	          p.z = p.dz;
	          
	          p.r = 4 * devScale;
	          //p.f = getRandomColor();
	          p.f = 'gray';

	        } else {
	          p.x += (p.dx - p.x) * speed;
	          p.y += (p.dy - p.y) * speed;
	          p.z += (p.dz - p.z) * speed;
	        }
	      } else {
	        if (Math.abs(p.x - p.tx) < 0.1 && Math.abs(p.y - p.ty) < 0.1) {
	          p.x = p.tx;
	          p.y = p.ty;
	          p.z = p.tz;
	          drift = true;
	          pause = true;
	        } else {
	          p.x += (p.tx - p.x) * speed;
	          p.y += (p.ty - p.y) * speed;
	          p.z += (p.tz - p.z) * speed;
	        }
	      }
	      
	    }
      stats.update();
	    num++;
	    if (num < interval/1000 * 60) {
		  requestAnimationFrame(loop);
		}
	  })
  }
  exec();
})()