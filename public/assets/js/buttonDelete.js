const modalDelete = document.querySelector('.modal-delete')
const buttonCancel = document.querySelector('.button-cancel')
const buttonDelete = document.querySelector('.button-delete')

buttonDelete.addEventListener('click', () => {
    modalDelete.showModal()
})

buttonCancel.addEventListener('click', () => {
    modalDelete.close()
})

