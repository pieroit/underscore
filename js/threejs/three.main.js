$ = jQuery;
$(document).ready( function() {
	
	var camera;
	var sceneGL;
	var rendererGL;
	var sphere, cube, satel;
	var mouseX, mouseY;
	var projector = new THREE.Projector();
	
	initCanvas();
	initCamera();
	initLight();
	initStuff();
	animate();

	function initCanvas() {

		sceneGL = new THREE.Scene();
			
		//fallback for non-webGL browsers
		var rendOptions = {
			antialiasing: true,
			alpha: true
		};
		
		if(Detector.webgl) {
			rendererGL = new THREE.WebGLRenderer( rendOptions );
		} else {
			rendererGL = new THREE.CanvasRenderer( rendOptions );
		}
		
		rendererGL.setClearColor( 0x000000, 0 );	
		//rendererGL.setSize( window.innerWidth, window.innerHeight );
		rendererGL.domElement.style.position = 'fixed';
		$('body').append( rendererGL.domElement );
		$(rendererGL.domElement)
			.offset({ top: 0, left: 0 })
			.width('100px')
			.height('100px');
	}
	
	function initCamera() {
		
		var width = $(rendererGL.domElement).width();
		var height = $(rendererGL.domElement).height();

		var fov = 50;
		camera = new THREE.PerspectiveCamera( fov, width/height, 1, 1000 );
		camera.position = new THREE.Vector3(10,10,10);
		camera.lookAt( new THREE.Vector3() );
		sceneGL.add(camera);
		
		//window resize event
		window.addEventListener('resize', function() {
		  rendererGL.setSize(width, height);
		  camera.aspect = width / height;
		  camera.updateProjectionMatrix();
		});
	}
	
	function initLight() {
		//sceneGL.add( new THREE.AmbientLight( 0x111111 ) );

		light = new THREE.PointLight( 0xffffff, 3 );
		light.position.set( 10,0,0 );
		sceneGL.add( light );
		
		light = new THREE.PointLight( 0xffffff, 2 );
		light.position.set( 20,20,20 );
		sceneGL.add( light );
	}
	
	function initStuff() {
		var geometryS = new THREE.SphereGeometry(2.5,10,10);
		var materialS = new THREE.MeshPhongMaterial(/*{wireframe:true}*/);
		materialS.color.setRGB( 0,0,0.3 );
		sphere = new THREE.Mesh(geometryS, materialS);
		sphere.position = new THREE.Vector3( 0,0,0 );
		sceneGL.add(sphere);
		
		var geometryC = new THREE.BoxGeometry(1,1,1);
		var materialC = new THREE.MeshLambertMaterial();
		materialC.color.setRGB( 0.3,0,0 );
		cube = new THREE.Mesh(geometryC, materialC);
		cube.position = new THREE.Vector3( 5,0,0 );
		sphere.add(cube);
		
		var geometryS2 = new THREE.SphereGeometry(0.5,5,5);
		var materialS2 = new THREE.MeshLambertMaterial();
		materialS2.color.setRGB( 0,0.3,0 );
		satel = new THREE.Mesh(geometryS2, materialS2);
		satel.position = new THREE.Vector3( 2,0,0 );
		cube.add(satel);
	}
	
	function animate() {
	
		requestAnimationFrame( animate );
		
		if(mouseX !== undefined && mouseY !== undefined){
			var dist = Math.max(mouseX, mouseY);
			var speed = (1 - dist)/10;
			sphere.rotation.y += speed;
			cube.rotation.y -= speed*2;
			
			// Opacity
			sphere.material.opacity = 1 - dist;
			cube.material.opacity = 1 - dist;
			satel.material.opacity = 1 - dist;
		}
		
		render();
	}

	function render() {
		rendererGL.render( sceneGL, camera );
	}
	
	function swapColor(a, b) {
		var rA = a.material.color.r;
		var gA = a.material.color.g;
		var bA = a.material.color.b;
		var rB = b.material.color.r;
		var gB = b.material.color.g;
		var bB = b.material.color.b;
		
		a.material.color.setRGB(rB,gB,bB);
		b.material.color.setRGB(rA,gA,bA);
	}
	
	// jQuery controls
		
	$(document).mousemove(function(e){
		mouseX = e.clientX/window.innerWidth;
		mouseY = e.clientY/window.innerHeight;
	});
	
	$(document).click(function(e){
		swapColor(sphere, cube);
		swapColor(cube, satel);
	});
});
