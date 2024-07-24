import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["content", "mobileMenu", "mobileOpenIcon", "mobileCloseIcon"]

    toggle() {
        this.contentTarget.classList.toggle('hidden')
    }

    toggleMobileMenu() {
        this.mobileMenuTarget.classList.toggle('hidden')
        this.iconMobileMenu()
    }

    iconMobileMenu() {
        if (this.mobileMenuTarget.classList.contains('hidden')) {
            this.mobileOpenIconTarget.classList.remove('hidden')
            this.mobileOpenIconTarget.classList.add('block')
            this.mobileCloseIconTarget.classList.add('hidden')
            this.mobileCloseIconTarget.classList.remove('block')
        } else {
            this.mobileCloseIconTarget.classList.remove('hidden')
            this.mobileCloseIconTarget.classList.add('block')
            this.mobileOpenIconTarget.classList.add('hidden')
            this.mobileOpenIconTarget.classList.remove('block')
        }
    }
}
