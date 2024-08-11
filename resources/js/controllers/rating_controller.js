import { Controller } from "@hotwired/stimulus"

// Connects to data-controller="rating"
export default class extends Controller {
    static targets = ["stars", "note"]

    connect() {
        this.starsTargets.forEach((star, index) => {
            star.addEventListener('click', () => {
                const note = index + 1
                this.noteTarget.value = note
                this.noteTarget.dispatchEvent(new Event('input'));

                this.starsTargets.forEach((s, i) => {
                    if (i <= index) {
                        s.classList.add('text-yellow-400', 'dark:text-yellow-400')
                    } else {
                        s.classList.remove('text-yellow-400', 'dark:text-yellow-400')
                    }
                })
            })
        })
    }
}
