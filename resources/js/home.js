const orbit = document.getElementById('orbit');
const orbitImages = [
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLZDrORj8t6DH-_TTY6u1KkZV6BzpdVp6AKA&s',
    'https://raw.githubusercontent.com/bablubambal/All_logo_and_pictures/1ac69ce5fbc389725f16f989fa53c62d6e1b4883/programming%20languages/python.svg',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRIgHOaxgH5Q1Z2jvzhvadunzOgxNh4gnt8jA&s',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBPiuOnMmY_k0lmLoXKB0TctiAfAPLc3EdEP-8vSmISDhJyVFBPeIwYrW-kkSNLW44lwM&usqp=CAU',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2GBqKlTgJ9SzYYObejYZNMFYB9QrjQ-Spsw&s',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXz294_oR7i9wBoKKvK4DprypJBg0OKzwOyg&s',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d2/C_Sharp_Logo_2023.svg/640px-C_Sharp_Logo_2023.svg.png',
];

const planets = orbitImages.map(src => {
    const planet = document.createElement('div');
    planet.className = 'planet';

    const img = document.createElement('img');
    img.src = src;
    img.alt = 'orbiting';

    planet.appendChild(img);
    orbit.appendChild(planet);
    return planet;
});

let startTime = null;

function animate(time) {
    if (!startTime) startTime = time;
    const elapsed = time - startTime;

    const baseRadius = 120;
    const pulseAmplitude = 30;
    const pulse = baseRadius + pulseAmplitude * Math.sin(elapsed * 0.0005);
    const angleOffset = elapsed * 0.0002;

    const centerX = 160;
    const centerY = 160;
    const planetCount = planets.length;

    planets.forEach((planet, i) => {
        const angle = angleOffset + (i / planetCount) * 2 * Math.PI;
        const x = centerX + pulse * Math.cos(angle);
        const y = centerY + pulse * Math.sin(angle);

        planet.style.transform = `translate(${(x - 40).toFixed(2)}px, ${(y - 40).toFixed(2)}px)`;
    });

    requestAnimationFrame(animate);
}

requestAnimationFrame(animate);