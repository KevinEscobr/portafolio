import * as THREE from 'three';

// Ejecutar Three.js solo si existe el contenedor del canvas (para no correrlo en el Dashboard)
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('canvas-container');
    if (!container) return;

    // --- Configuración básica de la Escena ---
    const scene = new THREE.Scene();
    
    // Cámara
    const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 100);
    camera.position.z = 25;

    // Renderizador optimizado
    const renderer = new THREE.WebGLRenderer({ 
        alpha: true, 
        antialias: window.devicePixelRatio < 2, // Desactivado en pantallas de muy alta densidad para rendimiento
        powerPreference: 'high-performance' 
    });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2)); // Limitar a 2x pixel ratio para rendimiento
    renderer.setSize(window.innerWidth, window.innerHeight);
    container.appendChild(renderer.domElement);

    // --- Luces ---
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.1);
    scene.add(ambientLight);

    const pointLight = new THREE.PointLight(0x10b981, 2.5, 40); // Luz esmeralda
    pointLight.position.set(10, 10, 10);
    scene.add(pointLight);

    const secondaryLight = new THREE.PointLight(0x0b3c2d, 2.0, 50); // Luz verde pino
    secondaryLight.position.set(-15, -10, 5);
    scene.add(secondaryLight);

    // --- Textura procedural para las partículas (Evita cargas de red) ---
    function createParticleTexture() {
        const canvas = document.createElement('canvas');
        canvas.width = 32;
        canvas.height = 32;
        const ctx = canvas.getContext('2d');
        const gradient = ctx.createRadialGradient(16, 16, 0, 16, 16, 16);
        gradient.addColorStop(0, 'rgba(255, 255, 255, 1)');
        gradient.addColorStop(0.2, 'rgba(52, 211, 153, 0.8)'); // emerald-400
        gradient.addColorStop(0.6, 'rgba(11, 60, 45, 0.3)');    // pine green
        gradient.addColorStop(1, 'rgba(0, 0, 0, 0)');
        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, 32, 32);
        return new THREE.CanvasTexture(canvas);
    }
    const particleTexture = createParticleTexture();

    // --- 1. Sistema de Partículas (Fondo 3D Constelación Verde Pino) ---
    const particleCount = window.innerWidth < 768 ? 800 : 2000; // Reducir partículas en móvil
    const particleGeometry = new THREE.BufferGeometry();
    const positions = new Float32Array(particleCount * 3);
    const colors = new Float32Array(particleCount * 3);

    // Paleta de colores verde pino / esmeralda
    const colorOptions = [
        new THREE.Color('#0b3c2d'), // Verde pino oscuro
        new THREE.Color('#14532d'), // Verde bosque
        new THREE.Color('#10b981'), // Esmeralda brillante
        new THREE.Color('#047857'), // Esmeralda medio
        new THREE.Color('#064e3b'), // Verde azulado muy oscuro
    ];

    for (let i = 0; i < particleCount * 3; i += 3) {
        // Posiciones aleatorias en caja 3D
        positions[i] = (Math.random() - 0.5) * 60;
        positions[i + 1] = (Math.random() - 0.5) * 60;
        positions[i + 2] = (Math.random() - 0.5) * 50 - 10;

        // Asignar color aleatorio de la paleta
        const selectedColor = colorOptions[Math.floor(Math.random() * colorOptions.length)];
        colors[i] = selectedColor.r;
        colors[i + 1] = selectedColor.g;
        colors[i + 2] = selectedColor.b;
    }

    particleGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    particleGeometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));

    // Material de las partículas
    const particleMaterial = new THREE.PointsMaterial({
        size: 0.15,
        sizeAttenuation: true,
        vertexColors: true,
        transparent: true,
        opacity: 0.75,
        map: particleTexture,
        blending: THREE.AdditiveBlending,
        depthWrite: false
    });

    const particleSystem = new THREE.Points(particleGeometry, particleMaterial);
    scene.add(particleSystem);

    // --- 2. Objeto 3D Central Procedural (Núcleo Holográfico) ---
    // Un octaedro / icosaedro doble interactivo
    const coreGeometry = new THREE.IcosahedronGeometry(3.5, 1);
    
    // Material 1: Sólido translúcido esmeralda/pino
    const coreMaterial = new THREE.MeshPhysicalMaterial({
        color: 0x0b3c2d,
        roughness: 0.2,
        metalness: 0.8,
        clearcoat: 1.0,
        clearcoatRoughness: 0.1,
        transparent: true,
        opacity: 0.4,
        flatShading: true
    });
    const coreMesh = new THREE.Mesh(coreGeometry, coreMaterial);
    
    // Material 2: Estructura de alambre (Wireframe) brillante
    const wireMaterial = new THREE.MeshBasicMaterial({
        color: 0x10b981,
        wireframe: true,
        transparent: true,
        opacity: 0.35
    });
    const wireMesh = new THREE.Mesh(coreGeometry, wireMaterial);
    coreMesh.add(wireMesh); // El wireframe gira junto al core
    
    scene.add(coreMesh);

    // Ajustar posición del objeto 3D según ancho de pantalla
    function positionCoreMesh() {
        if (window.innerWidth < 1024) {
            coreMesh.position.set(0, 0, 0); // Centrado en móviles
            coreMesh.scale.set(0.7, 0.7, 0.7);
        } else {
            coreMesh.position.set(7, 0, 0); // Desplazado a la derecha en PC
            coreMesh.scale.set(1, 1, 1);
        }
    }
    positionCoreMesh();

    // --- 3. Interactividad y Eventos ---
    let mouseX = 0;
    let mouseY = 0;
    let targetX = 0;
    let targetY = 0;

    let scrollPercent = 0;

    // Seguimiento del mouse
    window.addEventListener('mousemove', (e) => {
        // Normalizar valores entre -0.5 y 0.5
        mouseX = (e.clientX / window.innerWidth) - 0.5;
        mouseY = (e.clientY / window.innerHeight) - 0.5;
    });

    // Seguimiento del scroll
    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY || document.documentElement.scrollTop;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        scrollPercent = docHeight > 0 ? (scrollTop / docHeight) : 0;
    });

    // Redimensionamiento
    window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
        positionCoreMesh();
    });

    // --- 4. Bucle de Animación con Control de Visibilidad ---
    let lastTime = 0;
    let isTabActive = true;

    // Detectar si el usuario cambia de pestaña para pausar los cálculos
    document.addEventListener('visibilitychange', () => {
        isTabActive = !document.hidden;
    });

    function animate(time) {
        if (!isTabActive) {
            requestAnimationFrame(animate);
            return;
        }

        const delta = time - lastTime;
        lastTime = time;

        // Suave interpolación (easing) del movimiento del mouse
        targetX += (mouseX - targetX) * 0.05;
        targetY += (mouseY - targetY) * 0.05;

        // Rotación básica del núcleo holográfico
        coreMesh.rotation.y += 0.005;
        coreMesh.rotation.x += 0.003;

        // Modulación por mouse
        coreMesh.rotation.y += targetX * 0.1;
        coreMesh.rotation.x += targetY * 0.1;

        // Modulación por scroll (rota más rápido a medida que baja y flota levemente)
        coreMesh.rotation.z = scrollPercent * Math.PI;
        coreMesh.position.y = Math.sin(time * 0.001) * 0.8 - (scrollPercent * 4);
        
        // Mover cámara sutilmente a través del campo de partículas al hacer scroll
        camera.position.z = 25 - (scrollPercent * 10);
        camera.position.x = targetX * 4;
        camera.position.y = -targetY * 4;
        camera.lookAt(0, 0, 0);

        // Rotación del sistema de partículas
        particleSystem.rotation.y = time * 0.00005;
        particleSystem.rotation.x = time * 0.00002;
        
        // Efecto viento sutil basado en el scroll
        particleSystem.position.y = scrollPercent * 5;

        renderer.render(scene, camera);
        requestAnimationFrame(animate);
    }

    requestAnimationFrame(animate);
});
