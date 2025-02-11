class SearchableSelect {
    constructor(container) {
        this.container = container;
        this.options = this.getOptionsFromAttribute();
        this.init();
    }

    getOptionsFromAttribute() {
        const optionsString = this.container.getAttribute('data-options');
        try {
            return optionsString ? JSON.parse(optionsString) : [];
        } catch (error) {
            console.error("Invalid JSON in data-options:", error);
            return [];
        }
    }

    init() {
        // Create the dropdown structure
        this.container.classList.add('aiob-searchable-dropdown');
        this.input = document.createElement('input');
        this.input.setAttribute('type', 'text');
        // this.input.setAttribute('placeholder', 'Search...');
        this.list = document.createElement('ul');
        this.list.classList.add('aiob-searchable-dropdown-list');

        // Append elements to container
        this.container.appendChild(this.input);
        this.container.appendChild(this.list);

        // Populate dropdown
        this.populateList();

        // Event listeners
        this.input.addEventListener('click', () => this.toggleDropdown(true));
        this.input.addEventListener('keyup', () => this.filterOptions());
        document.addEventListener('click', (event) => this.handleClickOutside(event));
    }

    populateList() {
        this.list.innerHTML = ''; // Clear existing options
        this.options.forEach(option => {
            const li = document.createElement('li');
            li.textContent = option;
            li.addEventListener('click', () => this.selectOption(option));
            this.list.appendChild(li);
        });
    }

    toggleDropdown(show) {
        this.list.style.display = show ? 'block' : 'none';
    }

    filterOptions() {
        const searchValue = this.input.value.toLowerCase();
        this.list.childNodes.forEach(li => {
            if (li.textContent.toLowerCase().includes(searchValue)) {
                li.style.display = 'block';
            } else {
                li.style.display = 'none';
            }
        });
    }

    selectOption(value) {
        this.input.value = value;
        this.toggleDropdown(false);
    }

    handleClickOutside(event) {
        if (!this.container.contains(event.target)) {
            this.toggleDropdown(false);
        }
    }
}

// Auto-initialize all elements with data-options
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-options]').forEach(element => new SearchableSelect(element));
});
