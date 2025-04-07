import { get, post, del } from "./ajax"

document.addEventListener('DOMContentLoaded', () => {
    const resendLink = document.querySelector('.resend-verification-email');

    resendLink.addEventListener('click', event => {
        event.preventDefault()
        post(`verify/`)
            .then(response => response.json())
            .then(response => {
                alert('Email verification sent')
            })
    })
})