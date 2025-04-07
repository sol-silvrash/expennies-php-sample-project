import { Modal } from "bootstrap";
import { get, post, del } from "./ajax"
import { clearError } from "./util";
import DataTable from "datatables.net-bs5";

document.addEventListener('DOMContentLoaded', function () {
    const categoryEditModal = new Modal(document.querySelector('#editCategoryModal'))
    const categoryEditModalElement = categoryEditModal._element;

    const table = new DataTable("#categoriesTable", {
        serverSide: true,
        ajax: '/categories/load',
        orderMulti: false,
        columns: [
            {
                data: "name",
                className: "align-middle",
                orderSequence: ['asc', 'desc']
            },
            {
                data: "createdAt",
                className: "align-middle",
                orderSequence: ['asc', 'desc'],
            },
            {
                data: "updatedAt",
                className: "align-middle",
                orderSequence: ['asc', 'desc']
            },
            {
                sortable: false,
                data: row =>
                    `<div class="d-flex">
						<button class="me-2 btn btn-outline-success edit-category-btn" data-id="${row.id}">
							<i class="bi bi-pencil-fill"></i>
						</button>
						<button class="me-2 btn btn-outline-danger delete-category-btn" data-id="${row.id}">
							<i class="bi bi-trash3-fill"></i>
						</button>
					</div>`
            }
        ]
    })

    document.querySelector('#categoriesTable').addEventListener('click', event => {
        const editBtn = event.target.closest('.edit-category-btn')
        const deleteBtn = event.target.closest('.delete-category-btn')

        if (editBtn) {
            clearError(categoryCreateModalElement)

            const categoryId = editBtn.getAttribute('data-id')
            get(`/categories/${categoryId}`)
                .then(response => response.json())
                .then(response => {
                    categoryEditModalElement.querySelector('input[name="name"]').value = response.name
                    categoryEditModalElement.querySelector('.save-category-btn').setAttribute('data-id', response.id)
                    categoryEditModal.show()
                })

        } else if (deleteBtn) {
            clearError(categoryCreateModalElement)

            const categoryId = deleteBtn.getAttribute('data-id')
            if (confirm('Are you sure you want to delete this category?'))
                del(`/categories/${categoryId}`).then(response => {
                    if (response.ok)
                        table.draw()
                })
        }
    })

    const categoryCreateModal = new Modal(document.querySelector('#newCategoryModal'))
    const categoryCreateModalElement = categoryCreateModal._element;

    document.querySelector('.create-category-btn').addEventListener('click', () => {
        clearError(categoryCreateModalElement)

        post('/categories', {
            name: categoryCreateModalElement.querySelector('input[name="name"]').value
        }, categoryCreateModalElement).then(response => {
            if (response.ok) {
                table.draw()
                categoryCreateModal.hide()
                categoryCreateModalElement.querySelector('input[name="name"]').value = ""
            }
        })
    })

    document.querySelector('.save-category-btn').addEventListener('click', event => {
        const categoryId = event.target.getAttribute('data-id')

        post(`/categories/${categoryId}`, {
            name: categoryEditModalElement.querySelector('input[name="name"]').value
        }, categoryEditModalElement).then(response => {
            if (response.ok) {
                table.draw()
                categoryEditModal.hide()
            }
        })
    })
})