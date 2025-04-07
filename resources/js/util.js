function datenow() {
    var now = new Date()
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset())
    return now.toISOString().slice(0, 16)
}

function clearError(domElement) {
    domElement.querySelectorAll('.is-invalid').forEach(element => {
        element.classList.remove('is-invalid')
        element.parentNode.querySelectorAll('.invalid-feedback').forEach(e => {
            e.remove()
        })
    })
}

export {
    datenow,
    clearError
}