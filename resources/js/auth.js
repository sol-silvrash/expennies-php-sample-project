import "../css/auth.scss";

import { post } from './ajax';
import { Modal } from 'bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const twoFactorAuthModal = new Modal(document.querySelector('#twoFactorAuthModal'))
    const loginControl = document.querySelector('.login-control')

    loginControl.addEventListener('click', () => {
        const form = document.querySelector('#login-form')
        const formdata = new FormData(form)
        const inputs = Object.fromEntries(formdata.entries())

        post(form.action, inputs, form)
            .then(response => response.json())
            .then(response => {
                if (response.two_factor)
                    twoFactorAuthModal.show()
                else
                    window.location = '/'
            })
    })

    document.querySelector('.login-twofactor').addEventListener('click', () => {
        const code = twoFactorAuthModal._element.querySelector('.twofactor-code').value
        const email = document.querySelector('#login-email').value

        post('/login/two-factor', { email, code }, twoFactorAuthModal._element)
            .then(response => {
                if (response.ok)
                    window.location = '/'
            })
    })
})