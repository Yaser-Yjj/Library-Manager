<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Three.js Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<section class="hero-section">
    <style>
        .hero-3d-container {
            position: relative;
            width: 100%;
            height: 500px;
            border-radius: 30px;
            overflow: hidden;
            background: transparent;
        }
        #library3d {
            width: 100%;
            height: 100%;
            cursor: grab;
        }
        #library3d:active {
            cursor: grabbing;
        }
        .canvas-overlay {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(102,126,234,0.15);
            backdrop-filter: blur(10px);
            padding: 10px 25px;
            border-radius: 50px;
            color: #667eea;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            pointer-events: none;
            border: 1px solid rgba(102,126,234,0.2);
        }
        .canvas-overlay i {
            animation: wiggle 2s ease-in-out infinite;
        }
        @keyframes wiggle {
            0%, 100% { transform: rotate(-10deg); }
            50% { transform: rotate(10deg); }
        }
        .loading-3d {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            color: #667eea;
            font-size: 1.2rem;
            z-index: 10;
            transition: opacity 0.5s ease;
        }
        .loading-3d.hidden {
            opacity: 0;
            pointer-events: none;
        }
        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(102,126,234,0.2);
            border-top-color: #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        @media (max-width: 991px) {
            .hero-3d-container {
                height: 350px;
                margin-top: 2rem;
            }
        }
    </style>
    
    <div class="hero-content">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-6 hero-text">
                <span class="badge bg-primary mb-3 animate-fade-in">Welcome to Our Library</span>
                <h1 class="display-3 fw-bold mb-4 animate-slide-up">
                    Discover Your Next 
                    <span class="text-gradient">Favorite Book</span>
                </h1>
                <p class="lead mb-4 text-muted animate-slide-up delay-1">
                    Explore thousands of books, borrow your favorites, or purchase to keep forever. 
                    Your reading journey starts here.
                </p>
                <div class="d-flex gap-3 flex-wrap animate-slide-up delay-2">
                    <a href="<?= base_url('books') ?>" class="btn btn-primary btn-lg px-4 py-3 rounded-pill">
                        <i class="bi bi-book me-2"></i>Browse Library
                    </a>
                    <?php if (!session()->get('isLoggedIn')): ?>
                        <a href="<?= base_url('auth/register') ?>" class="btn btn-outline-dark btn-lg px-4 py-3 rounded-pill">
                            <i class="bi bi-person-plus me-2"></i>Join Now
                        </a>
                    <?php endif; ?>
                </div>
                
                <!-- Stats -->
                <div class="row mt-5 pt-4 animate-fade-in delay-3">
                    <div class="col-4">
                        <div class="stat-item">
                            <h3 class="fw-bold text-primary mb-0 counter" data-target="<?= $totalBooks ?? 500 ?>">0</h3>
                            <p class="text-muted small mb-0">Books Available</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-item">
                            <h3 class="fw-bold text-success mb-0 counter" data-target="<?= $totalUsers ?? 200 ?>">0</h3>
                            <p class="text-muted small mb-0">Happy Readers</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-item">
                            <h3 class="fw-bold text-warning mb-0 counter" data-target="50">0</h3>
                            <p class="text-muted small mb-0">Categories</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- 3D Library Canvas -->
            <div class="col-lg-6 animate-fade-in">
                <div class="hero-3d-container">
                    <div class="loading-3d" id="loading3d">
                        <div class="text-center">
                            <div class="loading-spinner mx-auto mb-3"></div>
                            <div>Loading 3D Library...</div>
                        </div>
                    </div>
                    <canvas id="library3d"></canvas>
                    <div class="canvas-overlay">
                        <i class="bi bi-mouse"></i>
                        <span>Move mouse to explore</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Three.js 3D Library Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scene setup
    const canvas = document.getElementById('library3d');
    const container = canvas.parentElement;
    const loadingEl = document.getElementById('loading3d');
    
    const scene = new THREE.Scene();
    
    // Camera - centered view
    const camera = new THREE.PerspectiveCamera(50, container.clientWidth / container.clientHeight, 0.1, 1000);
    camera.position.set(0, 0, 16);
    
    // Renderer
    const renderer = new THREE.WebGLRenderer({ canvas: canvas, antialias: true, alpha: true });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFSoftShadowMap;
    
    // Lighting
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.4);
    scene.add(ambientLight);
    
    const mainLight = new THREE.DirectionalLight(0xffffff, 1);
    mainLight.position.set(5, 10, 5);
    mainLight.castShadow = true;
    mainLight.shadow.mapSize.width = 1024;
    mainLight.shadow.mapSize.height = 1024;
    scene.add(mainLight);
    
    const purpleLight = new THREE.PointLight(0x667eea, 1.5, 15);
    purpleLight.position.set(-5, 3, 2);
    scene.add(purpleLight);
    
    const pinkLight = new THREE.PointLight(0xf5576c, 1, 15);
    pinkLight.position.set(5, 2, 3);
    scene.add(pinkLight);
    
    // Book colors palette
    const bookColors = [
        0x667eea, 0x764ba2, 0xf5576c, 0x11998e, 0x38ef7d,
        0xfc5c7d, 0x6a82fb, 0xfc466b, 0x3f5efb, 0x5ee7df,
        0xf093fb, 0xf8b500, 0x00c6fb, 0xff6b6b, 0xfeca57
    ];
    
    // Create bookshelf group
    const library = new THREE.Group();
    
    // Create wooden bookshelf
    const woodMaterial = new THREE.MeshLambertMaterial({ color: 0x3d2b1f });
    
    // Shelf dimensions
    const shelfWidth = 10;
    const shelfHeight = 8;
    const shelfDepth = 1.5;
    const shelfThickness = 0.15;
    const numShelves = 4;
    
    // Back panel
    const backPanel = new THREE.Mesh(
        new THREE.BoxGeometry(shelfWidth, shelfHeight, 0.1),
        new THREE.MeshLambertMaterial({ color: 0x2a1f14 })
    );
    backPanel.position.z = -shelfDepth / 2;
    library.add(backPanel);
    
    // Side panels
    const sideGeometry = new THREE.BoxGeometry(shelfThickness, shelfHeight, shelfDepth);
    const leftSide = new THREE.Mesh(sideGeometry, woodMaterial);
    leftSide.position.set(-shelfWidth / 2 + shelfThickness / 2, 0, 0);
    library.add(leftSide);
    
    const rightSide = new THREE.Mesh(sideGeometry, woodMaterial);
    rightSide.position.set(shelfWidth / 2 - shelfThickness / 2, 0, 0);
    library.add(rightSide);
    
    // Horizontal shelves
    const shelfSpacing = shelfHeight / (numShelves + 1);
    for (let i = 0; i <= numShelves; i++) {
        const shelfY = -shelfHeight / 2 + shelfThickness / 2 + i * shelfSpacing;
        const shelf = new THREE.Mesh(
            new THREE.BoxGeometry(shelfWidth - shelfThickness * 2, shelfThickness, shelfDepth),
            woodMaterial
        );
        shelf.position.y = shelfY;
        shelf.receiveShadow = true;
        library.add(shelf);
    }
    
    // Create books
    const books = [];
    
    function createBook(x, y, z, height, color, rotationY = 0) {
        const bookGroup = new THREE.Group();
        
        // Book body
        const bookWidth = 0.3 + Math.random() * 0.2;
        const bookHeight = height;
        const bookDepth = 0.8 + Math.random() * 0.3;
        
        const bookMaterial = new THREE.MeshLambertMaterial({ color: color });
        const book = new THREE.Mesh(
            new THREE.BoxGeometry(bookWidth, bookHeight, bookDepth),
            bookMaterial
        );
        book.castShadow = true;
        bookGroup.add(book);
        
        // Book spine detail (lighter stripe)
        const spineMaterial = new THREE.MeshLambertMaterial({ 
            color: new THREE.Color(color).lerp(new THREE.Color(0xffffff), 0.3)
        });
        const spine = new THREE.Mesh(
            new THREE.BoxGeometry(bookWidth + 0.01, bookHeight * 0.1, bookDepth * 0.3),
            spineMaterial
        );
        spine.position.y = bookHeight * 0.2;
        spine.position.z = bookDepth * 0.2;
        bookGroup.add(spine);
        
        // Pages (white edge)
        const pagesMaterial = new THREE.MeshLambertMaterial({ color: 0xf5f5dc });
        const pages = new THREE.Mesh(
            new THREE.BoxGeometry(bookWidth - 0.05, bookHeight - 0.05, bookDepth * 0.02),
            pagesMaterial
        );
        pages.position.z = bookDepth / 2;
        bookGroup.add(pages);
        
        bookGroup.position.set(x, y, z);
        bookGroup.rotation.y = rotationY;
        bookGroup.userData = { 
            originalY: y,
            floatOffset: Math.random() * Math.PI * 2,
            floatSpeed: 0.5 + Math.random() * 0.5
        };
        
        return bookGroup;
    }
    
    // Populate shelves with books
    for (let shelfIndex = 0; shelfIndex < numShelves; shelfIndex++) {
        const shelfY = -shelfHeight / 2 + shelfThickness + (shelfIndex + 1) * shelfSpacing;
        const shelfTop = shelfY + shelfThickness / 2;
        
        let x = -shelfWidth / 2 + 0.5;
        const maxX = shelfWidth / 2 - 0.5;
        
        while (x < maxX) {
            const bookHeight = 0.8 + Math.random() * 0.8;
            const color = bookColors[Math.floor(Math.random() * bookColors.length)];
            const book = createBook(
                x,
                shelfTop + bookHeight / 2,
                0,
                bookHeight,
                color,
                (Math.random() - 0.5) * 0.15
            );
            library.add(book);
            books.push(book);
            x += 0.4 + Math.random() * 0.2;
        }
    }
    
    // Add library to scene
    scene.add(library);
    
    // Create floating books around the shelf
    const floatingBooks = [];
    
    function createFloatingBook(x, y, z, height, color) {
        const bookGroup = new THREE.Group();
        
        const bookWidth = 0.4;
        const bookDepth = 1;
        
        const bookMaterial = new THREE.MeshLambertMaterial({ color: color });
        const book = new THREE.Mesh(
            new THREE.BoxGeometry(bookWidth, height, bookDepth),
            bookMaterial
        );
        book.castShadow = true;
        bookGroup.add(book);
        
        // Spine detail
        const spineMaterial = new THREE.MeshLambertMaterial({ 
            color: new THREE.Color(color).lerp(new THREE.Color(0xffffff), 0.3)
        });
        const spine = new THREE.Mesh(
            new THREE.BoxGeometry(bookWidth + 0.01, height * 0.15, bookDepth * 0.4),
            spineMaterial
        );
        spine.position.y = height * 0.2;
        spine.position.z = bookDepth * 0.2;
        bookGroup.add(spine);
        
        // Pages
        const pages = new THREE.Mesh(
            new THREE.BoxGeometry(bookWidth - 0.05, height - 0.05, 0.02),
            new THREE.MeshLambertMaterial({ color: 0xf5f5dc })
        );
        pages.position.z = bookDepth / 2;
        bookGroup.add(pages);
        
        bookGroup.position.set(x, y, z);
        bookGroup.userData = {
            originalY: y,
            originalX: x,
            floatOffset: Math.random() * Math.PI * 2,
            floatSpeed: 0.8 + Math.random() * 0.4,
            rotationSpeed: 0.01 + Math.random() * 0.02
        };
        
        return bookGroup;
    }
    
    // Add floating books - positioned closer to shelf
    const floatingPositions = [
        { x: -5.5, y: 3, z: 3, color: 0x667eea },
        { x: 5, y: 3.5, z: 2.5, color: 0xf5576c },
        { x: -4.5, y: -2.5, z: 4, color: 0x11998e },
        { x: 4.5, y: -2, z: 3, color: 0xf093fb },
        { x: 0, y: 4.5, z: 4, color: 0xfeca57 },
    ];
    
    floatingPositions.forEach((pos) => {
        const book = createFloatingBook(pos.x, pos.y, pos.z, 1.2 + Math.random() * 0.5, pos.color);
        scene.add(book);
        floatingBooks.push(book);
    });
    
    // Create a person reading
    const personGroup = new THREE.Group();
    
    // Skin color
    const skinMaterial = new THREE.MeshLambertMaterial({ color: 0xf5d0c5 });
    const hairMaterial = new THREE.MeshLambertMaterial({ color: 0x3d2314 });
    const shirtMaterial = new THREE.MeshLambertMaterial({ color: 0x667eea });
    const pantsMaterial = new THREE.MeshLambertMaterial({ color: 0x2d3748 });
    
    // Head
    const head = new THREE.Mesh(
        new THREE.SphereGeometry(0.4, 16, 16),
        skinMaterial
    );
    head.position.y = 2.8;
    personGroup.add(head);
    
    // Hair
    const hair = new THREE.Mesh(
        new THREE.SphereGeometry(0.42, 16, 16, 0, Math.PI * 2, 0, Math.PI / 2),
        hairMaterial
    );
    hair.position.y = 2.9;
    personGroup.add(hair);
    
    // Body/Torso
    const torso = new THREE.Mesh(
        new THREE.CylinderGeometry(0.35, 0.4, 1.2, 8),
        shirtMaterial
    );
    torso.position.y = 1.8;
    personGroup.add(torso);
    
    // Arms
    const armGeometry = new THREE.CylinderGeometry(0.1, 0.1, 0.8, 8);
    
    // Left arm (holding book)
    const leftArm = new THREE.Mesh(armGeometry, shirtMaterial);
    leftArm.position.set(-0.5, 1.8, 0.3);
    leftArm.rotation.x = -0.8;
    leftArm.rotation.z = 0.3;
    personGroup.add(leftArm);
    
    // Right arm (holding book)
    const rightArm = new THREE.Mesh(armGeometry, shirtMaterial);
    rightArm.position.set(0.5, 1.8, 0.3);
    rightArm.rotation.x = -0.8;
    rightArm.rotation.z = -0.3;
    personGroup.add(rightArm);
    
    // Hands
    const handGeometry = new THREE.SphereGeometry(0.12, 8, 8);
    const leftHand = new THREE.Mesh(handGeometry, skinMaterial);
    leftHand.position.set(-0.35, 1.5, 0.7);
    personGroup.add(leftHand);
    
    const rightHand = new THREE.Mesh(handGeometry, skinMaterial);
    rightHand.position.set(0.35, 1.5, 0.7);
    personGroup.add(rightHand);
    
    // Book in hands
    const readingBook = new THREE.Mesh(
        new THREE.BoxGeometry(0.6, 0.8, 0.08),
        new THREE.MeshLambertMaterial({ color: 0xf5576c })
    );
    readingBook.position.set(0, 1.5, 0.8);
    readingBook.rotation.x = -0.4;
    personGroup.add(readingBook);
    
    // Book pages
    const bookPages = new THREE.Mesh(
        new THREE.BoxGeometry(0.55, 0.75, 0.02),
        new THREE.MeshLambertMaterial({ color: 0xfffff0 })
    );
    bookPages.position.set(0, 1.5, 0.85);
    bookPages.rotation.x = -0.4;
    personGroup.add(bookPages);
    
    // Legs
    const legGeometry = new THREE.CylinderGeometry(0.12, 0.12, 1.2, 8);
    
    const leftLeg = new THREE.Mesh(legGeometry, pantsMaterial);
    leftLeg.position.set(-0.2, 0.6, 0);
    personGroup.add(leftLeg);
    
    const rightLeg = new THREE.Mesh(legGeometry, pantsMaterial);
    rightLeg.position.set(0.2, 0.6, 0);
    personGroup.add(rightLeg);
    
    // Shoes
    const shoeGeometry = new THREE.BoxGeometry(0.18, 0.12, 0.35);
    const shoeMaterial = new THREE.MeshLambertMaterial({ color: 0x1a1a1a });
    
    const leftShoe = new THREE.Mesh(shoeGeometry, shoeMaterial);
    leftShoe.position.set(-0.2, 0.05, 0.08);
    personGroup.add(leftShoe);
    
    const rightShoe = new THREE.Mesh(shoeGeometry, shoeMaterial);
    rightShoe.position.set(0.2, 0.05, 0.08);
    personGroup.add(rightShoe);
    
    // Position person to the left side of the shelf (scaled smaller)
    personGroup.scale.set(0.7, 0.7, 0.7);
    personGroup.position.set(-7, -2.5, 3);
    personGroup.rotation.y = 0.4;
    scene.add(personGroup);
    
    // Create a second person on the right (sitting/reading)
    const person2Group = new THREE.Group();
    
    // Second person materials
    const skin2Material = new THREE.MeshLambertMaterial({ color: 0xdeb887 });
    const hair2Material = new THREE.MeshLambertMaterial({ color: 0x1a1a1a });
    const shirt2Material = new THREE.MeshLambertMaterial({ color: 0xf5576c });
    
    // Head
    const head2 = new THREE.Mesh(new THREE.SphereGeometry(0.35, 16, 16), skin2Material);
    head2.position.y = 1.6;
    person2Group.add(head2);
    
    // Hair
    const hair2 = new THREE.Mesh(
        new THREE.SphereGeometry(0.37, 16, 16, 0, Math.PI * 2, 0, Math.PI / 2),
        hair2Material
    );
    hair2.position.y = 1.7;
    person2Group.add(hair2);
    
    // Body (sitting pose)
    const torso2 = new THREE.Mesh(
        new THREE.CylinderGeometry(0.3, 0.35, 0.9, 8),
        shirt2Material
    );
    torso2.position.y = 0.9;
    person2Group.add(torso2);
    
    // Arms holding book
    const arm2Geo = new THREE.CylinderGeometry(0.08, 0.08, 0.6, 8);
    const leftArm2 = new THREE.Mesh(arm2Geo, shirt2Material);
    leftArm2.position.set(-0.4, 0.9, 0.25);
    leftArm2.rotation.x = -0.7;
    leftArm2.rotation.z = 0.2;
    person2Group.add(leftArm2);
    
    const rightArm2 = new THREE.Mesh(arm2Geo, shirt2Material);
    rightArm2.position.set(0.4, 0.9, 0.25);
    rightArm2.rotation.x = -0.7;
    rightArm2.rotation.z = -0.2;
    person2Group.add(rightArm2);
    
    // Book in hands
    const book2 = new THREE.Mesh(
        new THREE.BoxGeometry(0.5, 0.7, 0.06),
        new THREE.MeshLambertMaterial({ color: 0x667eea })
    );
    book2.position.set(0, 0.7, 0.6);
    book2.rotation.x = -0.3;
    person2Group.add(book2);
    
    // Legs (crossed/sitting)
    const leg2Geo = new THREE.CylinderGeometry(0.1, 0.1, 0.7, 8);
    const pants2Material = new THREE.MeshLambertMaterial({ color: 0x4a5568 });
    
    const leftLeg2 = new THREE.Mesh(leg2Geo, pants2Material);
    leftLeg2.position.set(-0.15, 0.25, 0.2);
    leftLeg2.rotation.x = Math.PI / 2.2;
    person2Group.add(leftLeg2);
    
    const rightLeg2 = new THREE.Mesh(leg2Geo, pants2Material);
    rightLeg2.position.set(0.15, 0.25, 0.2);
    rightLeg2.rotation.x = Math.PI / 2.2;
    person2Group.add(rightLeg2);
    
    person2Group.scale.set(0.65, 0.65, 0.65);
    person2Group.position.set(6.5, -3.2, 3);
    person2Group.rotation.y = -0.5;
    scene.add(person2Group);
    
    // Mouse tracking
    let mouseX = 0;
    let mouseY = 0;
    let targetRotationX = 0;
    let targetRotationY = 0;
    
    container.addEventListener('mousemove', (e) => {
        const rect = container.getBoundingClientRect();
        mouseX = ((e.clientX - rect.left) / rect.width) * 2 - 1;
        mouseY = -((e.clientY - rect.top) / rect.height) * 2 + 1;
    });
    
    // Animation
    const clock = new THREE.Clock();
    
    function animate() {
        requestAnimationFrame(animate);
        
        const elapsedTime = clock.getElapsedTime();
        
        // Smooth rotation based on mouse
        targetRotationY = mouseX * 0.3;
        targetRotationX = mouseY * 0.15;
        
        library.rotation.y += (targetRotationY - library.rotation.y) * 0.05;
        library.rotation.x += (targetRotationX - library.rotation.x) * 0.05;
        
        // Animate floating books
        floatingBooks.forEach((book, i) => {
            book.rotation.y += book.userData.rotationSpeed;
            book.rotation.z = Math.sin(elapsedTime * 0.5 + i) * 0.15;
            book.position.y = book.userData.originalY + Math.sin(elapsedTime * book.userData.floatSpeed + book.userData.floatOffset) * 0.5;
            book.position.x = book.userData.originalX + Math.cos(elapsedTime * 0.3 + i) * 0.3;
        });
        
        // Animate person 1 (left side - standing)
        personGroup.position.y = -2.5 + Math.sin(elapsedTime * 1.5) * 0.05;
        personGroup.rotation.y = 0.4 + Math.sin(elapsedTime * 0.5) * 0.08;
        
        // Animate person 2 (right side - sitting)
        person2Group.position.y = -3.2 + Math.sin(elapsedTime * 1.2 + 1) * 0.04;
        person2Group.rotation.y = -0.5 + Math.sin(elapsedTime * 0.4) * 0.06;
        
        // Animate lights
        purpleLight.position.x = Math.sin(elapsedTime * 0.5) * 5;
        pinkLight.position.x = Math.cos(elapsedTime * 0.3) * 5;
        
        renderer.render(scene, camera);
    }
    
    // Handle resize
    function onResize() {
        camera.aspect = container.clientWidth / container.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(container.clientWidth, container.clientHeight);
    }
    
    window.addEventListener('resize', onResize);
    
    // Hide loading and start animation
    setTimeout(() => {
        loadingEl.classList.add('hidden');
    }, 500);
    
    animate();
});
</script>

<!-- Features Section -->
<section class="features-section py-5 my-5">
    <div class="text-center mb-5">
        <span class="badge bg-light text-primary mb-2">Why Choose Us</span>
        <h2 class="display-5 fw-bold">Everything You Need</h2>
        <p class="text-muted">Discover the features that make our library special</p>
    </div>
    
    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon bg-primary-soft">
                    <i class="bi bi-book"></i>
                </div>
                <h5 class="mt-4 mb-3">Vast Collection</h5>
                <p class="text-muted">Access thousands of books across multiple genres and categories.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="feature-card animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="feature-icon bg-success-soft">
                    <i class="bi bi-arrow-left-right"></i>
                </div>
                <h5 class="mt-4 mb-3">Easy Borrowing</h5>
                <p class="text-muted">Borrow books with just a click and return them when you're done.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="feature-card animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="feature-icon bg-warning-soft">
                    <i class="bi bi-cart-check"></i>
                </div>
                <h5 class="mt-4 mb-3">Purchase Books</h5>
                <p class="text-muted">Buy your favorite books at competitive prices to keep forever.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="feature-card animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="feature-icon bg-info-soft">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h5 class="mt-4 mb-3">Secure & Safe</h5>
                <p class="text-muted">Your data and transactions are protected with top security.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Books Section -->
<?php if (!empty($featuredBooks)): ?>
<section class="featured-books-section py-5 my-5">
    <style>
        .featured-books-section {
            background: linear-gradient(135deg, #f8f9ff 0%, #fff5f7 100%);
            border-radius: 30px;
            padding: 60px 30px;
            position: relative;
            overflow: hidden;
        }
        .featured-books-section::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(102,126,234,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        .featured-books-section::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(245,87,108,0.08) 0%, transparent 70%);
            border-radius: 50%;
        }
        .featured-header {
            position: relative;
            z-index: 1;
        }
        .featured-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            box-shadow: 0 8px 25px rgba(245,87,108,0.3);
            animation: badgePulse 2s ease-in-out infinite;
        }
        @keyframes badgePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .featured-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: #1a1a2e;
            margin-bottom: 8px;
        }
        .featured-book-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            position: relative;
            z-index: 1;
        }
        .featured-book-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 60px rgba(102,126,234,0.25);
        }
        .featured-book-cover {
            height: 320px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .featured-book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .featured-book-card:hover .featured-book-cover img {
            transform: scale(1.1) rotate(2deg);
        }
        .book-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.7) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 20px;
        }
        .featured-book-card:hover .book-overlay {
            opacity: 1;
        }
        .overlay-btn {
            background: white;
            color: #667eea;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transform: translateY(20px);
            transition: all 0.4s ease;
        }
        .featured-book-card:hover .overlay-btn {
            transform: translateY(0);
        }
        .overlay-btn:hover {
            background: #667eea;
            color: white;
            transform: translateY(-3px);
        }
        .book-badge-corner {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 2;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .book-badge-available {
            background: linear-gradient(135deg, rgba(40,167,69,0.95) 0%, rgba(56,239,125,0.95) 100%);
            color: white;
        }
        .book-badge-out {
            background: linear-gradient(135deg, rgba(220,53,69,0.95) 0%, rgba(245,87,108,0.95) 100%);
            color: white;
        }
        .featured-book-info {
            padding: 1.5rem;
            background: white;
        }
        .featured-book-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
            height: 2.8em;
            color: #1a1a2e;
        }
        .featured-book-author {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .featured-book-author i {
            font-size: 0.8rem;
            color: #667eea;
        }
        .featured-book-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            gap: 10px;
            border-top: 2px solid #f3f4f6;
        }
        .featured-book-price {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .featured-view-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .featured-view-btn:hover {
            transform: translateX(5px);
            box-shadow: 0 8px 20px rgba(102,126,234,0.4);
            color: white;
        }
        .view-all-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(102,126,234,0.3);
        }
        .view-all-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102,126,234,0.5);
            color: white;
        }
        .view-all-link i {
            transition: transform 0.3s ease;
        }
        .view-all-link:hover i {
            transform: translateX(5px);
        }
    </style>
    
    <div class="featured-header">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <div class="featured-badge mb-3">
                    <i class="bi bi-star-fill"></i>
                    <span>Featured Collection</span>
                </div>
                <h2 class="featured-title">Popular Books</h2>
                <p class="text-muted mb-0">Discover our most loved titles</p>
            </div>
            <a href="<?= base_url('books') ?>" class="view-all-link">
                View All Books
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <div class="row g-4">
            <?php foreach (array_slice($featuredBooks, 0, 4) as $index => $book): ?>
                <?php $coverUrl = \App\Models\BookModel::getCoverUrl($book['cover_image'] ?? null, $book['title']); ?>
                <div class="col-md-6 col-lg-3">
                    <div class="featured-book-card animate-on-scroll" style="animation-delay: <?= $index * 0.1 ?>s;">
                        <div class="featured-book-cover">
                            <img src="<?= $coverUrl ?>" 
                                 alt="<?= esc($book['title']) ?>"
                                 onerror="this.src='https://placehold.co/300x450/667eea/ffffff?text=<?= urlencode(strtoupper(substr($book['title'], 0, 1))) ?>'">
                            
                            <?php if ($book['stock_quantity'] > 0): ?>
                                <span class="book-badge-corner book-badge-available">
                                    <i class="bi bi-check-circle-fill me-1"></i>Available
                                </span>
                            <?php else: ?>
                                <span class="book-badge-corner book-badge-out">
                                    <i class="bi bi-x-circle-fill me-1"></i>Out of Stock
                                </span>
                            <?php endif; ?>
                            
                            <div class="book-overlay">
                                <a href="<?= base_url('books/' . $book['id']) ?>" class="overlay-btn">
                                    <i class="bi bi-eye me-2"></i>Quick View
                                </a>
                            </div>
                        </div>
                        
                        <div class="featured-book-info">
                            <h5 class="featured-book-title"><?= esc($book['title']) ?></h5>
                            <p class="featured-book-author">
                                <i class="bi bi-person-fill"></i>
                                <?= esc($book['author']) ?>
                            </p>
                            <div class="featured-book-footer">
                                <span class="featured-book-price">$<?= number_format($book['price'], 2) ?></span>
                                <a href="<?= base_url('books/' . $book['id']) ?>" class="featured-view-btn">
                                    Details
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- How It Works Section -->
<section class="how-it-works-section py-5 my-5">
    <style>
        .how-it-works-section {
            background: linear-gradient(180deg, #f8f9ff 0%, #ffffff 100%);
            padding: 80px 0;
            position: relative;
        }
        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 20px;
            box-shadow: 0 8px 30px rgba(102,126,234,0.3);
        }
        .section-title {
            font-size: 3rem;
            font-weight: 800;
            color: #1a1a2e;
            margin-bottom: 15px;
        }
        .section-subtitle {
            font-size: 1.2rem;
            color: #6b7280;
            max-width: 500px;
            margin: 0 auto 60px;
        }
        
        /* Timeline Container */
        .timeline-container {
            position: relative;
            max-width: 1000px;
            margin: 0 auto;
        }
        
        /* Connecting Line */
        .timeline-line {
            position: absolute;
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            width: 70%;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #11998e, #f5576c);
            border-radius: 2px;
            z-index: 0;
        }
        @media (max-width: 991px) {
            .timeline-line { display: none; }
        }
        
        /* Step Item */
        .step-item {
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        /* Number Circle */
        .step-num {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
            margin: 0 auto 30px;
            position: relative;
            cursor: pointer;
            transition: all 0.4s ease;
        }
        .step-num.num-1 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 10px 30px rgba(102,126,234,0.4); }
        .step-num.num-2 { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); box-shadow: 0 10px 30px rgba(17,153,142,0.4); }
        .step-num.num-3 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); box-shadow: 0 10px 30px rgba(245,87,108,0.4); }
        
        /* Pulse Ring Animation */
        .step-num::before {
            content: '';
            position: absolute;
            inset: -8px;
            border-radius: 50%;
            border: 3px solid currentColor;
            opacity: 0;
            animation: pulseRing 2s ease-out infinite;
        }
        .step-num.num-1::before { border-color: #667eea; }
        .step-num.num-2::before { border-color: #11998e; animation-delay: 0.5s; }
        .step-num.num-3::before { border-color: #f5576c; animation-delay: 1s; }
        
        @keyframes pulseRing {
            0% { transform: scale(1); opacity: 0.6; }
            100% { transform: scale(1.4); opacity: 0; }
        }
        
        .step-item:hover .step-num {
            transform: scale(1.15) rotate(10deg);
        }
        
        /* Icon Container */
        .step-icon-box {
            width: 120px;
            height: 120px;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 25px;
            position: relative;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .step-icon-box.box-1 { 
            background: linear-gradient(135deg, rgba(102,126,234,0.1) 0%, rgba(118,75,162,0.15) 100%); 
            color: #667eea;
        }
        .step-icon-box.box-2 { 
            background: linear-gradient(135deg, rgba(17,153,142,0.1) 0%, rgba(56,239,125,0.15) 100%); 
            color: #11998e;
        }
        .step-icon-box.box-3 { 
            background: linear-gradient(135deg, rgba(240,147,251,0.1) 0%, rgba(245,87,108,0.15) 100%); 
            color: #f5576c;
        }
        
        .step-item:hover .step-icon-box {
            transform: translateY(-10px) scale(1.05);
            border-radius: 35px;
        }
        .step-item:hover .step-icon-box.box-1 { box-shadow: 0 20px 40px rgba(102,126,234,0.25); }
        .step-item:hover .step-icon-box.box-2 { box-shadow: 0 20px 40px rgba(17,153,142,0.25); }
        .step-item:hover .step-icon-box.box-3 { box-shadow: 0 20px 40px rgba(245,87,108,0.25); }
        
        /* Floating Icon Animation */
        .step-icon-box i {
            animation: floatIcon 3s ease-in-out infinite;
        }
        .step-item:nth-child(1) .step-icon-box i { animation-delay: 0s; }
        .step-item:nth-child(2) .step-icon-box i { animation-delay: 0.5s; }
        .step-item:nth-child(3) .step-icon-box i { animation-delay: 1s; }
        
        @keyframes floatIcon {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        
        /* Text Content */
        .step-title-text {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 12px;
        }
        .step-desc {
            font-size: 1rem;
            color: #6b7280;
            line-height: 1.7;
            max-width: 280px;
            margin: 0 auto;
        }
        
        /* Arrow connectors for desktop */
        .step-arrow {
            position: absolute;
            top: 80px;
            right: -40px;
            font-size: 1.5rem;
            color: #667eea;
            opacity: 0.5;
            animation: arrowMove 1.5s ease-in-out infinite;
        }
        @keyframes arrowMove {
            0%, 100% { transform: translateX(0); opacity: 0.5; }
            50% { transform: translateX(8px); opacity: 1; }
        }
        @media (max-width: 991px) {
            .step-arrow { display: none; }
        }
    </style>
    
    <div class="text-center">
        <div class="section-badge">
            <i class="bi bi-lightning-charge-fill"></i>
            <span>Simple Process</span>
        </div>
        <h2 class="section-title">How It Works</h2>
        <p class="section-subtitle">Get started with BookHub in just 3 simple steps and begin your reading journey today</p>
    </div>
    
    <div class="timeline-container">
        <div class="timeline-line"></div>
        
        <div class="row g-4 g-lg-5">
            <!-- Step 1 -->
            <div class="col-lg-4">
                <div class="step-item">
                    <div class="step-num num-1">1</div>
                    <div class="step-icon-box box-1">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h4 class="step-title-text">Create Account</h4>
                    <p class="step-desc">Sign up for free in just a few seconds. Join our community of passionate readers.</p>
                    <div class="step-arrow d-none d-lg-block">
                        <i class="bi bi-chevron-double-right"></i>
                    </div>
                </div>
            </div>
            
            <!-- Step 2 -->
            <div class="col-lg-4">
                <div class="step-item">
                    <div class="step-num num-2">2</div>
                    <div class="step-icon-box box-2">
                        <i class="bi bi-search"></i>
                    </div>
                    <h4 class="step-title-text">Discover Books</h4>
                    <p class="step-desc">Browse our extensive library. Find your next favorite read from thousands of titles.</p>
                    <div class="step-arrow d-none d-lg-block">
                        <i class="bi bi-chevron-double-right"></i>
                    </div>
                </div>
            </div>
            
            <!-- Step 3 -->
            <div class="col-lg-4">
                <div class="step-item">
                    <div class="step-num num-3">3</div>
                    <div class="step-icon-box box-3">
                        <i class="bi bi-book-half"></i>
                    </div>
                    <h4 class="step-title-text">Start Reading</h4>
                    <p class="step-desc">Borrow or buy instantly. Enjoy unlimited access to knowledge and adventure.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section py-5 my-5">
    <div class="text-center mb-5">
        <span class="badge bg-light text-primary mb-2">Testimonials</span>
        <h2 class="display-5 fw-bold">What Readers Say</h2>
    </div>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="testimonial-card animate-on-scroll">
                <div class="stars mb-3">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
                <p class="mb-4">"Amazing library with a great collection. The borrowing process is so smooth and easy!"</p>
                <div class="d-flex align-items-center">
                    <div class="avatar bg-primary text-white">JD</div>
                    <div class="ms-3">
                        <h6 class="mb-0">John Doe</h6>
                        <small class="text-muted">Book Enthusiast</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="testimonial-card animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="stars mb-3">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
                <p class="mb-4">"I love how I can both borrow and purchase books. Great prices and excellent service!"</p>
                <div class="d-flex align-items-center">
                    <div class="avatar bg-success text-white">SM</div>
                    <div class="ms-3">
                        <h6 class="mb-0">Sarah Miller</h6>
                        <small class="text-muted">Avid Reader</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="testimonial-card animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="stars mb-3">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-half text-warning"></i>
                </div>
                <p class="mb-4">"The best online library I've used. Clean interface and fantastic book selection!"</p>
                <div class="d-flex align-items-center">
                    <div class="avatar bg-warning text-white">MJ</div>
                    <div class="ms-3">
                        <h6 class="mb-0">Mike Johnson</h6>
                        <small class="text-muted">Student</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5 my-5">
    <div class="cta-card text-center text-white p-5 rounded-4">
        <h2 class="display-5 fw-bold mb-3">Ready to Start Reading?</h2>
        <p class="lead mb-4 opacity-75">Join thousands of readers and explore our vast collection today.</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <?php if (session()->get('isLoggedIn')): ?>
                <a href="<?= base_url('books') ?>" class="btn btn-light btn-lg px-5 py-3 rounded-pill">
                    <i class="bi bi-book me-2"></i>Explore Books
                </a>
            <?php else: ?>
                <a href="<?= base_url('auth/register') ?>" class="btn btn-light btn-lg px-5 py-3 rounded-pill">
                    <i class="bi bi-rocket-takeoff me-2"></i>Get Started Free
                </a>
                <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
