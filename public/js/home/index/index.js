(function(){
  //fabric.Object.prototype.originX = fabric.Object.prototype.originY = 'center';
  fabric.Object.prototype.transparentCorners = false;	
  var canvas = this.__canvas = new fabric.Canvas('c'),
  radius = 150,
  cx = canvas.getWidth() / 2,
  cy = canvas.getHeight() / 2;

  fabric.Image.fromURL("img/aa.jpg",function(image){
    image.set({
      width: 100,
      height: 100,
      left: 40,
      originX: 'left',
      originY: 'top',
      top: canvas.getHeight() / 2 - image.getHeight()/2,
      opacity: 1,
      selection: false,
      hasControls: false,
      hasBorders: false,
      clipTo: function(ctx) {
      	ctx.lineWidth = 5;
      	ctx.strokeStyle = 'purple';
      	ctx.arc(0, 0, 50, 0, Math.PI * 2, true);
      	ctx.stroke();
      }
  	}).scale(1);
  	__canvas.add(image);
  	this.__image = image;
  })
  __canvas.on('mouse:over', function(e){
  	e.target.scale(2);
  	canvas.renderAll();
  })
  __canvas.on('mouse:out', function(e){
  	e.target.scale(1);
  	canvas.renderAll();
  })
  function animate() {
  	//var isStart = Math.round(__image.getLeft()) === 0 && Math.round(__image.getTop()) === 200;
  	var isStart = Math.round(__image.getAngle() % 360 === 0);
  	__image&&__image.animate({
  	  //left: isStart ? 400 : 0,
  	  //top: isStart ? 0 : 200,
  	  //opacity: isStart ? 1 : 0.5,
  	  angle: __image.getAngle() + 359,
  	}, {
  	  duration: 8000,
  	  onChange: function() {
  	  	angle = fabric.util.degreesToRadians(__image.getAngle());
//console.log(__image.getAngle());
      	var x = cx + radius * Math.cos(angle);
      	var y = cy + radius * Math.sin(angle);

      	__image.set({ left: x, top: y }).setCoords();
  	  	__canvas.renderAll();
  	  },
  	  easing: function(t, b, c, d) { return c*t/d + b },
  	  onComplete: function() {
  	  	animate();
  	  }
  	})
  }
  window.onload = function() {
	if (typeof(__image) === 'undefined') return;
	animate();
  }
})()