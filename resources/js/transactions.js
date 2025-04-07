import { Modal } from "bootstrap"
import { get, post, del, ajax } from "./ajax"
import { datenow, clearError } from './util'
import DataTable from "datatables.net-bs5"

document.addEventListener('DOMContentLoaded', () => {
    const transaction_modal = new Modal(document.querySelector('#transaction-modal'))
    const transaction_modal_element = transaction_modal._element

    const transaction_receipt_modal = new Modal(document.querySelector('#transaction-receipt-modal'))
    const transaction_receipt_modal_element = transaction_receipt_modal._element

    const transaction_csv_modal = new Modal(document.querySelector('#transaction-csv-modal'))
    const transaction_csv_modal_element = transaction_csv_modal._element

    const formdata = {
        id: null,
        status: false,
        title: document.querySelector('.form-title'),
        input: {
            description: document.querySelector('#description'),
            date: document.querySelector('#date'),
            amount: document.querySelector('#amount'),
            category: document.querySelector('#category'),
        },
        receipt: {
            id: null,
            file: document.querySelector("#transaction-receipt-upload")
        },
        csv: {
            file: document.querySelector('#transaction-csv-upload')
        }
    }

    const table = new DataTable('#transaction-table', {
        serverSide: true,
        ajax: '/transactions/load',
        orderMulti: false,
        rowCallback: (row, data) => {
            if (!data.wasReviewed)
                row.classList.add('fw-bold')
            return row
        },
        columns: [
            {
                className: "align-middle",
                orderSequence: ['asc', 'desc'],
                data: "description",
            },
            {
                className: "align-middle",
                orderSequence: ['asc', 'desc'],
                data: row => {
                    if (row.amount_inversed)
                        return `<span class="text-danger">-${row.amount}</span>`
                    return `<span class="text-success">${row.amount}</span>`
                },
            },
            {
                className: "align-middle",
                orderSequence: ['asc', 'desc'],
                data: row => {
                    let category = row.category
                    return (category == '') ? '<span class="text-danger">None</span>' : category
                },
            },
            {
                sortable: false,
                className: 'align-middle',
                data: row => {
                    let icons = []

                    row.receipts.forEach(receipt => {
                        const span = document.createElement('span')
                        const anchor = document.createElement('a')
                        const icon = document.createElement('i')
                        const spanDelete = document.createElement('span')
                        const deleteIcon = document.createElement('i')


                        icon.classList.add(
                            'bi',
                            'bi-file-earmark-text',
                            'download-receipt',
                            'text-primary',
                            'fs-4',
                        )

                        anchor.href = `/transactions/${row.id}/receipts/${receipt.id}`
                        anchor.target = 'blank'
                        anchor.title = receipt.name
                        anchor.append(icon)

                        anchor.classList.add(
                            'position-relative',
                        )

                        deleteIcon.role = 'button'
                        deleteIcon.classList.add(
                            'bi',
                            'bi-x-circle-fill',
                            'small',
                            'delete-receipt',
                            'text-danger',
                        )
                        deleteIcon.setAttribute('data-id', receipt.id)
                        deleteIcon.setAttribute('data-transaction-id', row.id)

                        spanDelete.classList.add(
                            'position-absolute',
                            'translate-middle',
                        )
                        spanDelete.append(deleteIcon)


                        span.classList.add(
                            'position-relative',
                            'me-2',
                        )
                        span.append(anchor)
                        span.append(spanDelete)

                        icons.push(span.outerHTML)
                    })

                    return icons.join('')
                }
            },
            {
                data: "date",
                className: "align-middle",
                orderSequence: ['asc', 'desc'],
            },
            {
                sortable: false,
                className: 'align-middle',
                data: row => `
                    <div class="d-flex gap-2">
                        <div>
                            <i class="bi ${row.wasReviewed ? 'bi-check-circle-fill text-success' : 'bi-check-circle'} toggle-reviewed-btn fs-4" 
                                role="button" data-id="${row.id}"></i>
                        </div>
                        <div class="dropdown">
                            <i class="bi bi-gear fs-4" role="button" data-bs-toggle="dropdown"></i>

                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item upload-transaction-btn" href="#" data-id="${row.id}">
                                        <i class="bi bi-upload me-2"></i> Upload Receipt
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item edit-transaction-btn" href="#" data-id="${row.id}">
                                        <i class="bi bi-pencil-fill me-2"></i> Edit
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item delete-transaction-btn" href="#" data-id="${row.id}">
                                        <i class="bi bi-trash3-fill me-2"></i> Delete
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                `
            }
        ],
    })

    transaction_modal_element.addEventListener('hide.bs.modal', () => {
        transaction_modal_element.blur()
    })

    transaction_modal_element.addEventListener('show.bs.modal', () => {
        clearError(transaction_modal_element)
    })

    transaction_receipt_modal_element.addEventListener('show.bs.modal', () => {
        clearError(transaction_receipt_modal_element)
    })

    document.querySelector('.create-transaction-btn').addEventListener('click', () => {
        formdata_info("New Transaction",
            null,
            true,
            "",
            datenow(),
            "",
            "")
    })

    document.querySelector('.save-transaction-btn').addEventListener('click', () => {
        let data = {
            description: formdata.input.description.value,
            date: formdata.input.date.value,
            amount: formdata.input.amount.value,
            category: formdata.input.category.value
        }

        let url = '/transactions' + ((!formdata.status) ? '/' + formdata.id : '')
        post(url, data, transaction_modal_element)
            // .then(response => response.json())
            .then(response => {
                if (response.ok) {
                    table.draw()
                    transaction_modal.hide()
                }
            })
    })

    document.querySelector('.upload-transaction-receipt-btn').addEventListener('click', () => {
        var form = new FormData()
        let files = formdata.receipt.file.files

        Array.from(files).forEach(file => {
            form.append('receipt', file)
        })

        post(`/transactions/${formdata.id}/receipts`, form, transaction_receipt_modal_element)
            .then(response => {
                if (response.ok) {
                    transaction_receipt_modal.hide()
                    table.draw()
                }
            })
    })

    document.querySelector('.upload-transaction-csv-btn').addEventListener('click', event => {
        var element = event.currentTarget
        var form = new FormData()
        let files = formdata.csv.file.files

        Array.from(files).forEach(file => {
            form.append('csv', file)
        })

        element.setAttribute('disabled', true)

        const btnHtml = element.innerHTML

        event.innerHTML = `
            <div class="spinner-grow spinner-grow-sm text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow spinner-grow-sm text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow spinner-grow-sm text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        `

        post(`/transactions/upload/csv`, form, transaction_csv_modal_element)
            // .then(response => response.json())
            .then(response => {
                element.removeAttribute('disabled')
                element.innerHTML = btnHtml

                if (response.ok) {
                    transaction_csv_modal.hide()
                    table.draw()
                }
            })
    })

    document.querySelector('#transaction-table').addEventListener('click', event => {
        const button = {
            edit: event.target.closest('.edit-transaction-btn'),
            delete: event.target.closest('.delete-transaction-btn'),
            upload: event.target.closest('.upload-transaction-btn'),
            receipt: {
                delete: event.target.closest('.delete-receipt')
            },
            review: event.target.closest('.toggle-reviewed-btn')
        }

        if (button.edit) {
            const id = button.edit.getAttribute('data-id')

            get(`/transactions/${id}`)
                .then(response => response.json())
                .then(response => {
                    formdata_info("Edit Category",
                        id,
                        false,
                        response.description,
                        response.date,
                        response.amount,
                        response.category)

                    transaction_modal.show()
                })
        } else if (button.delete) {
            const id = button.delete.getAttribute('data-id')
            if (confirm('Are you sure you want to delete this transaction?'))
                del(`/transactions/${id}`)
                    // .then(response => response.json())
                    .then(response => {
                        if (response.ok)
                            table.draw()
                    })
        } else if (button.upload) {
            const id = button.upload.getAttribute('data-id')
            formdata.id = id
            formdata.receipt.file.value = null
            transaction_receipt_modal.show()
        } else if (button.receipt.delete) {
            const receiptId = button.receipt.delete.getAttribute('data-id')
            const transactionId = button.receipt.delete.getAttribute('data-transaction-id')

            if (confirm('Are you sure you want to delete this receipt?')) {
                del(`/transactions/${transactionId}/receipts/${receiptId}`)
                    // .then(response => response.json())
                    .then(response => {
                        if (response.ok) {
                            table.draw()
                        }
                    })
            }
        } else if (button.review) {
            const id = button.review.getAttribute('data-id')

            post(`/transactions/${id}/review`)
                .then(response => {
                    if (response.ok)
                        table.draw()
                })
        }
    })

    function formdata_info(title, id, status, description, date, amount, category) {
        formdata.title.innerHTML = title
        formdata.id = id
        formdata.status = status
        formdata.input.description.value = description
        formdata.input.date.value = date
        formdata.input.amount.value = amount
        formdata.input.category.value = category
    }
})
