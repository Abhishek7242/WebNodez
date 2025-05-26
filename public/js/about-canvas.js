/******/ (() => { // webpackBootstrap
/*!**************************************!*\
  !*** ./resources/js/about-canvas.js ***!
  \**************************************/
// Initialize Three.js scene for about page
var initAboutCanvas = function initAboutCanvas() {
  var container = document.getElementById('about-canvas');
  if (!container) return;
  var scene = new THREE.Scene();
  var camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
  var renderer = new THREE.WebGLRenderer({
    antialias: true,
    alpha: true
  });
  renderer.setSize(container.clientWidth, container.clientHeight);
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
  container.appendChild(renderer.domElement);

  // Optimize performance
  renderer.powerPreference = 'high-performance';
  renderer.shadowMap.enabled = true;
  renderer.shadowMap.type = THREE.PCFSoftShadowMap;

  // Add ambient light
  var ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
  scene.add(ambientLight);

  // Add directional light
  var directionalLight = new THREE.DirectionalLight(0xffffff, 1);
  directionalLight.position.set(5, 5, 5);
  directionalLight.castShadow = true;
  scene.add(directionalLight);

  // Create a torus knot
  var geometry = new THREE.TorusKnotGeometry(1, 0.3, 100, 16);
  var material = new THREE.MeshPhongMaterial({
    color: 0x6366f1,
    wireframe: true,
    transparent: true,
    opacity: 0.8
  });
  var torusKnot = new THREE.Mesh(geometry, material);
  scene.add(torusKnot);

  // Create particles
  var particlesGeometry = new THREE.BufferGeometry();
  var particlesCount = 1000;
  var posArray = new Float32Array(particlesCount * 3);
  for (var i = 0; i < particlesCount * 3; i++) {
    posArray[i] = (Math.random() - 0.5) * 10;
  }
  particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
  var particlesMaterial = new THREE.PointsMaterial({
    size: 0.02,
    color: 0x6366f1,
    transparent: true,
    opacity: 0.6
  });
  var particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
  scene.add(particlesMesh);
  camera.position.z = 5;

  // Animation
  var _animate = function animate() {
    requestAnimationFrame(_animate);

    // Rotate torus knot
    torusKnot.rotation.x += 0.01;
    torusKnot.rotation.y += 0.01;

    // Rotate particles
    particlesMesh.rotation.y += 0.001;
    renderer.render(scene, camera);
  };
  _animate();

  // Handle resize
  window.addEventListener('resize', function () {
    camera.aspect = container.clientWidth / container.clientHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(container.clientWidth, container.clientHeight);
  });
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', initAboutCanvas);
/******/ })()
;