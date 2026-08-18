const modalDelete = document.querySelector('.modal-delete')

document.querySelectorAll('.button-delete').forEach(elements => {
    elements.addEventListener('click', () => {
        document.getElementById('name-delete').textContent = elements.dataset.nome
        
        const linkGet = document.getElementById('link-get')
        linkGet.setAttribute('href', '?delete=' + elements.dataset.id)
        
        modalDelete.showModal()       
    })
})

document.querySelector('.button-cancel').addEventListener('click', () => {
    modalDelete.close()
})




