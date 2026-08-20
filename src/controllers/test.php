<style>
    .modal-simple::backdrop {
        background-color: rgba(0,0,0, .4);
    }

    .modal-simple {
        border: none;
        border-radius: 10px;
        background-color: silver;
        align-items: end;
    }
</style>

<p class="text">text1</p>
<p class="text">text2</p>
<p class="text">text3</p>
<p class="text">text4</p>
<p class="text">text5</p>
<p class="text">text6</p>
<strong id="name"></strong>
<button class="turn">To Turn</button>
<dialog class="modal-simple">
    <p>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</p>
    <div>
        <button>confirmar</button>
        <button>cancelar</button>       
    </div>
</dialog>

<script>
    document.querySelector('.turn').addEventListener('click', () => {
        const modalSimple = document.querySelector('.modal-simple')
        modalSimple.showModal()
    })
</script>