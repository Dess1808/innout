// function "auto invocada"
// para nao poluir o scope global
(function () {
        const menuToggle = document.querySelector('.menu-toggle')
        menuToggle.onclick = function(e){
        const body = document.querySelector('body')
        body.classList.toggle('hide-sidebar')
    }
})()


//clock functions
function addOneSecond(hours, minutes, seconds) {
    const d = new Date()

    d.setHours(parseInt(hours))
    d.setMinutes(parseInt(minutes))
    d.setSeconds(parseInt(seconds) + 1) // preciso atualizar o segundos manualmente

    //utilizando padStart() para alterar o valores da hora de "um digito", exemplo: 1 para 01
    const h = `${d.getHours()}`.padStart(2, 0)
    const m = `${d.getMinutes()}`.padStart(2, 0)
    const s = `${d.getSeconds()}`.padStart(2, 0)

    //hora atualizada
    return `${h}:${m}:${s}`
}

function activeClock() {
    const activeClock = document.querySelector('[active-clock]')

    if (!activeClock) 
        return

    setInterval(function(){
        //preciso deixar a string original no html ?? posso deixar sem??
        const parts = activeClock.innerHTML.split(':')
        activeClock.innerHTML = addOneSecond(...parts)
    }, 1000)
}

activeClock()


