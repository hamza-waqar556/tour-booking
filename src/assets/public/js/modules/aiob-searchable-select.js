class SearchableSelect {
    constructor(container) {
        this.container = container;
        this.options = this.getOptionsFromAttribute();
        this.hiddenInput = document.querySelector(`#${this.container.id}-input`); // Hidden input field
        this.init();
    }

    getOptionsFromAttribute() {
        try {
            return JSON.parse(this.container.getAttribute('data-options')) || [];
        } catch (error) {
            console.error("Invalid JSON in data-options:", error);
            return [];
        }
    }

    init() {
        this.container.classList.add('aiob-searchable-dropdown');

        this.input = document.createElement('input');
        this.input.setAttribute('type', 'text');
        this.list = document.createElement('ul');
        this.list.classList.add('aiob-searchable-dropdown-list');

        this.container.appendChild(this.input);
        this.container.appendChild(this.list);

        this.populateList();

        // Pre-fill input if there's a stored value
        if (this.hiddenInput.value) {
            this.input.value = this.hiddenInput.value;
        }

        // Event Listeners
        this.input.addEventListener('click', () => this.toggleDropdown(true));
        this.input.addEventListener('keyup', () => this.filterOptions());
        document.addEventListener('click', (event) => this.handleClickOutside(event));
    }

    populateList() {
        this.list.innerHTML = '';
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
            li.style.display = li.textContent.toLowerCase().includes(searchValue) ? 'block' : 'none';
        });
    }

    selectOption(value) {
        this.input.value = value;
        if (this.hiddenInput) {
            this.hiddenInput.value = value; // ✅ Store selected value in hidden input
        }
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
