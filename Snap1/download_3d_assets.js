const https = require('https');
const fs = require('fs');
const path = require('path');

const assetsDir = path.join(__dirname, 'assets', 'futuristic');

// Create directories if they don't exist
if (!fs.existsSync(assetsDir)) {
    fs.mkdirSync(assetsDir, { recursive: true });
}

// List of futuristic images to download
const images = [
    {
        url: 'https://raw.githubusercontent.com/your-repo/futuristic-assets/main/grid-pattern.png',
        filename: 'grid-pattern.png'
    },
    {
        url: 'https://raw.githubusercontent.com/your-repo/futuristic-assets/main/loading-pattern.png',
        filename: 'loading-pattern.png'
    },
    {
        url: 'https://raw.githubusercontent.com/your-repo/futuristic-assets/main/cyber-background.png',
        filename: 'cyber-background.png'
    }
];

// Function to download an image
function downloadImage(url, filename) {
    return new Promise((resolve, reject) => {
        const filePath = path.join(assetsDir, filename);
        const file = fs.createWriteStream(filePath);

        https.get(url, (response) => {
            response.pipe(file);
            file.on('finish', () => {
                file.close();
                console.log(`Downloaded: ${filename}`);
                resolve();
            });
        }).on('error', (err) => {
            fs.unlink(filePath, () => {});
            reject(err);
        });
    });
}

// Download all images
async function downloadAllImages() {
    try {
        for (const image of images) {
            await downloadImage(image.url, image.filename);
        }
        console.log('All images downloaded successfully!');
    } catch (error) {
        console.error('Error downloading images:', error);
    }
}

downloadAllImages(); 