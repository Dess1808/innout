<p class="text">text1</p>
<p class="text">text2</p>
<p class="text">text3</p>
<p class="text">text4</p>
<p class="text">text5</p>
<p class="text">text6</p>
<strong id="name"></strong>
<button class="turn">To Turn</button>

<script>
    const turn = document.querySelector('.turn')

    turn.addEventListener('click', () => {
        const elementText = document.querySelectorAll('.text')

        elementText.forEach(element => {
            element.style.color = "blue"
        })

        // document.getElementById('name').textContent = 'Gabriel'
        // document.querySelector('#name').textContent = 'Leticya'
    })
</script>