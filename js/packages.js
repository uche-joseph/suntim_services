// script.js
document.addEventListener('DOMContentLoaded', () => {
    const packageGrid = document.querySelector('.package-grid');
    const lightbox = document.getElementById('lightbox');
    const closeLightbox = document.getElementById('close-lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDescription = document.getElementById('lightbox-description');
    const similarPackagesContainer = document.getElementById('similar-packages-container');
    const comparisonBar = document.getElementById('comparison-bar');
    const comparisonItems = document.getElementById('comparison-items');
    const compareButton = document.getElementById('compare-button');
    const comparisonModal = document.getElementById('comparison-modal');
    const closeComparison = document.getElementById('close-comparison');
    const comparisonTable = document.getElementById('comparison-table');

    // Sample data (replace with backend data in production)
    const packages = [
        {
            id: 1,
            title: 'Study in Paris',
            description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            image: 'https://via.placeholder.com/300x200.png?text=Paris',
            country: 'france',
            programType: 'study-abroad',
            fieldOfStudy: 'arts',
            educationLevel: 'undergraduate',
            duration: '1 semester',
            price: '$10,000'
        },
        {
            id: 2,
            title: 'Business Internship in New York',
            description: 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            image: 'https://via.placeholder.com/300x200.png?text=New+York',
            country: 'usa',
            programType: 'internship',
            fieldOfStudy: 'business',
            educationLevel: 'graduate',
            duration: '3 months',
            price: '$8,000'
        },
        {
            id: 3,
            title: 'Engineering Exchange in Tokyo',
            description: 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.',
            image: 'https://via.placeholder.com/300x200.png?text=Tokyo',
            country: 'japan',
            programType: 'exchange',
            fieldOfStudy: 'engineering',
            educationLevel: 'undergraduate',
            duration: '1 year',
            price: '$15,000'
        },
        // Add more package objects here
    ];

    function createPackageCard(package) {
        const card = document.createElement('div');
        card.className = 'package-card';
        card.innerHTML = `
            <img src="${package.image}" alt="${package.title}">
            <h2>${package.title}</h2>
            <p>${package.description.substring(0, 100)}...</p>
            <button class="view-details" data-id="${package.id}">View Details</button>
            <button class="add-to-compare" data-id="${package.id}">Add to Compare</button>
        `;
        return card;
    }

    function renderPackages(packages) {
        packageGrid.innerHTML = '';
        packages.forEach(package => {
            const card = createPackageCard(package);
            packageGrid.appendChild(card);
        });
    }

    function filterPackages() {
        const country = document.getElementById('country').value;
        const programType = document.getElementById('program-type').value;
        const fieldOfStudy = document.getElementById('field-of-study').value;
        const educationLevel = document.getElementById('education-level').value;

        const filteredPackages = packages.filter(package => 
            (!country || package.country === country) &&
            (!programType || package.programType === programType) &&
            (!fieldOfStudy || package.fieldOfStudy === fieldOfStudy) &&
            (!educationLevel || package.educationLevel === educationLevel)
        );

        renderPackages(filteredPackages);
    }

    function showLightbox(package) {
        lightboxImage.src = package.image;
        lightboxTitle.textContent = package.title;
        lightboxDescription.textContent = package.description;
        renderSimilarPackages(package);
        lightbox.style.display = 'block';
        setTimeout(() => {
            lightbox.classList.add('show');
        }, 10);
    }

    function renderSimilarPackages(currentPackage) {
        const similarPackages = packages.filter(package => 
            package.id !== currentPackage.id &&
            (package.country === currentPackage.country ||
             package.programType === currentPackage.programType ||
             package.fieldOfStudy === currentPackage.fieldOfStudy)
        ).slice(0, 3);

        similarPackagesContainer.innerHTML = '';
        similarPackages.forEach(package => {
            const card = document.createElement('div');
            card.className = 'similar-package-card';
            card.innerHTML = `
                <h4>${package.title}</h4>
                <p>${package.description.substring(0, 50)}...</p>
            `;
            card.addEventListener('click', () => showLightbox(package));
            similarPackagesContainer.appendChild(card);
        });
    }

    const comparisonList = [];

    function addToComparison(packageId) {
        if (comparisonList.length >= 3) {
            alert('You can compare up to 3 packages at a time.');
            return;
        }

        const package = packages.find(p => p.id === packageId);
        if (package && !comparisonList.includes(package)) {
            comparisonList.push(package);
            updateComparisonBar();
        }
    }

    function removeFromComparison(packageId) {
        const index = comparisonList.findIndex(p => p.id === packageId);
        if (index !== -1) {
            comparisonList.splice(index, 1);
            updateComparisonBar();
        }
    }

    function updateComparisonBar() {
        comparisonItems.innerHTML = '';
        comparisonList.forEach(package => {
            const item = document.createElement('div');
            item.className = 'comparison-item';
            item.innerHTML = `
                ${package.title}
                <button class="remove-from-compare" data-id="${package.id}">&times;</button>
            `;
            comparisonItems.appendChild(item);
        });

        if (comparisonList.length > 0) {
            comparisonBar.classList.add('show');
        } else {
            comparisonBar.classList.remove('show');
        }
    }

    function showComparisonModal() {
        if (comparisonList.length < 2) {
            alert('Please select at least 2 packages to compare.');
            return;
        }

        const headers = ['Title', 'Country', 'Program Type', 'Field of Study', 'Education Level', 'Duration', 'Price'];
        let tableHTML = '<tr>' + headers.map(h => `<th>${h}</th>`).join('') + '</tr>';

        comparisonList.forEach(package => {
            tableHTML += `
                <tr>
                    <td>${package.title}</td>
                    <td>${package.country}</td>
                    <td>${package.programType}</td>
                    <td>${package.fieldOfStudy}</td>
                    <td>${package.educationLevel}</td>
                    <td>${package.duration}</td>
                    <td>${package.price}</td>
                </tr>
            `;
        });

        comparisonTable.innerHTML = tableHTML;
        comparisonModal.style.display = 'block';
        setTimeout(() => {
            comparisonModal.classList.add('show');
        }, 10);
    }

    // Event listeners
    document.querySelectorAll('.filter select').forEach(select => {
        select.addEventListener('change', filterPackages);
    });

    packageGrid.addEventListener('click', (e) => {
        if (e.target.classList.contains('view-details')) {
            const packageId = parseInt(e.target.getAttribute('data-id'));
            const package = packages.find(p => p.id === packageId);
            if (package) {
                showLightbox(package);
            }
        } else if (e.target.classList.contains('add-to-compare')) {
            const packageId = parseInt(e.target.getAttribute('data-id'));
            addToComparison(packageId);
        }
    });

    closeLightbox.addEventListener('click', () => {
        lightbox.classList.remove('show');
        setTimeout(() => {
            lightbox.style.display = 'none';
        }, 300);
    });

    comparisonItems.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-from-compare')) {
            const packageId = parseInt(e.target.getAttribute('data-id'));
            removeFromComparison(packageId);
        }
    });

    compareButton.addEventListener('click', showComparisonModal);

    closeComparison.addEventListener('click', () => {
        comparisonModal.classList.remove('show');
        setTimeout(() => {
            comparisonModal.style.display = 'none';
        }, 300);
    });

    // Initial render
    renderPackages(packages);
});