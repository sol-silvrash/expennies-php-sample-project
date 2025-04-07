import { Modal } from 'bootstrap'
import { post } from './ajax'
import { clearError } from './util'

document.addEventListener('DOMContentLoaded', () => {
    const changePasswordModal = new Modal(document.querySelector('#changePasswordModal'))

    changePasswordModal._element.addEventListener('hide.bs.modal', () => {
        clearError(changePasswordModal._element)
    })

    document.querySelector('#saveChanges').addEventListener('click', () => {
        post(`/profile`, {
            name: document.querySelector('#name').value,
            is2fa: document.querySelector('#tfaCheck').checked
        })
            // .then(response => response.json())
            .then(response => {
                if (response.ok) {
                    alert('Profile has been updated.')
                    location.reload()
                }
            })
    })

    document.querySelector("#savePasswordChanges").addEventListener('click', () => {
        post(`/profile/save-password`, {
            currentPassword: document.querySelector('#currentPassword').value,
            newPassword: document.querySelector('#newPassword').value,
        }, changePasswordModal._element)
            // .then(response => response.json())
            .then(response => {
                if (response.ok) {
                    alert('password changed')
                    location.reload()
                }
            })
    })
})