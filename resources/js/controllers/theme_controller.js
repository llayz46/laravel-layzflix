import { Controller } from "@hotwired/stimulus"

// Connects to data-controller="theme"
export default class extends Controller {
    static targets = ["body", "toggle", "button", "container", "iconLight", "iconDark"]

    connect() {
        this.theme = localStorage.getItem('theme');
        this.applyTheme();
    }

    toggle() {
        this.bodyTarget.classList.toggle("dark")
        localStorage.setItem("theme", this.bodyTarget.classList.contains("dark") ? "dark" : "light")
        this.applyTheme();
    }

    applyTheme() {
        if (this.theme === 'dark') {
            this.bodyTarget.classList.add('dark');
        } else {
            this.bodyTarget.classList.remove('dark');
        }

        if (this.hasButtonTarget) {
            this.stylingButton();
        }
    }

    stylingButton() {
        if (this.theme === "dark") {
            this.buttonTarget.classList.remove('bg-gray-200')
            this.buttonTarget.classList.add('bg-primary-500')
            this.containerTarget.classList.remove('translate-x-0')
            this.containerTarget.classList.add('translate-x-5')
            this.iconLightTarget.classList.remove('opacity-100')
            this.iconLightTarget.classList.add('opacity-0')
            this.iconDarkTarget.classList.remove('opacity-0')
            this.iconDarkTarget.classList.add('opacity-100')
        } else {
            this.buttonTarget.classList.remove('bg-primary-500')
            this.buttonTarget.classList.add('bg-gray-200')
            this.containerTarget.classList.remove('translate-x-5')
            this.containerTarget.classList.add('translate-x-0')
            this.iconDarkTarget.classList.remove('opacity-100')
            this.iconDarkTarget.classList.add('opacity-0')
            this.iconLightTarget.classList.remove('opacity-0')
            this.iconLightTarget.classList.add('opacity-100')
        }
    }
}
