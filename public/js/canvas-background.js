/******/ (() => { // webpackBootstrap
/*!*******************************************!*\
  !*** ./resources/js/canvas-background.js ***!
  \*******************************************/
// Initialize Three.js scene
var initCanvasBackground = function initCanvasBackground() {
  var container = document.getElementById('canvas-background');
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

  // Create particles
  var particlesGeometry = new THREE.BufferGeometry();
  var particlesCount = 2000;
  var posArray = new Float32Array(particlesCount * 3);
  for (var i = 0; i < particlesCount * 3; i++) {
    posArray[i] = (Math.random() - 0.5) * 5;
  }
  particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
  var particlesMaterial = new THREE.PointsMaterial({
    size: 0.005,
    color: 0x6366f1,
    transparent: true,
    opacity: 0.8
  });
  var particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
  scene.add(particlesMesh);
  camera.position.z = 3;

  // Animation
  var _animate = function animate() {
    requestAnimationFrame(_animate);
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
document.addEventListener('DOMContentLoaded', initCanvasBackground);
/******/ })()
;