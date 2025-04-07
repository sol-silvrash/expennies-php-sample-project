const ajax = async (url, method = 'get', data = {}, domElement = null) => {
    method = method.toLowerCase()

    let options = {
        method,
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    }

    const csrfMethods = new Set(['post', 'put', 'delete', 'patch'])

    if (csrfMethods.has(method)) {
        let fields = { ...getCsrfFields() }

        if (method !== 'post') {
            options.method = 'post'

            fields._METHOD = method.toUpperCase()
        }

        if (data instanceof FormData) {
            for (const field in fields) {
                data.append(field, fields[field])
            }

            delete options.headers['Content-Type']
            options.body = data
        } else
            options.body = JSON.stringify({ ...data, ...fields })
    } else if (method === 'get') {
        url += '?' + (new URLSearchParams(data)).toString()
    }

    const response = await fetch(url, options)

    if (domElement)
        clearValidationErrors(domElement)

    if (!response.ok) {
        if (response.status === 422)
            response.json().then(errors => {
                handleValidationErrors(errors, domElement)
            })
        else if(response.status === 404)
            alert(response.statusText)
    }

    return response
}

const get = (url, data) => ajax(url, 'get', data)
const post = (url, data, domElement) => ajax(url, 'post', data, domElement)
const del = (url, data) => ajax(url, 'delete', data)

function getCsrfFields() {
    const csrfNameField = document.querySelector("#csrfName")
    const csrfNameKey = csrfNameField.getAttribute('name')
    const csrfName = csrfNameField.content

    const csrfValueField = document.querySelector("#csrfValue")
    const csrfValueKey = csrfValueField.getAttribute('name')
    const csrfValue = csrfValueField.content

    return {
        [csrfNameKey]: csrfName,
        [csrfValueKey]: csrfValue
    }
}

function handleValidationErrors(errors, domElement) {
    for (const name in errors) {
        const element = domElement.querySelector(`[name="${name}"]`)

        element.classList.add('is-invalid')

        const errorDiv = document.createElement('div')

        errorDiv.classList.add('invalid-feedback')
        errorDiv.textContent = errors[name][0]

        element.parentNode.append(errorDiv)
    }
}

function clearValidationErrors(domElement) {
    domElement.querySelectorAll('.is-invalid').forEach(element => {
        element.classList.remove('is-invalid')
        element.parentNode.querySelectorAll('.invalid-feedback').forEach(e => {
            e.remove()
        })
    });
}

export {
    ajax,
    get,
    post,
    del
}