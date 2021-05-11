let sender = null
document.querySelector('.simple-email-sender').addEventListener('click',()=>{
    console.log('aaa');
    if(!sender){
        let sender = document.createElement('iframe');
        sender.src = '/mail'
        let frameContainer = document.createElement('div')
        frameContainer.classList.add('iframe')
        let btn = document.createElement('div')
        btn.classList.add('btn-close')
        btn.textContent = 'X'
        btn.addEventListener('click',()=>{
            frameContainer.classList.add('hide')
        })
        frameContainer.appendChild(btn)
        frameContainer.appendChild(sender)
        document.body.appendChild(frameContainer)
    } else {
        frameContainer.classList.remove('hide')
    }
})
//////////////////////////////////////
let client = null
document.querySelector('.rest-client').addEventListener('click',()=>{
    if(!client){
        let sender = document.createElement('iframe');
        sender.src = '/client'
        let frameContainer = document.createElement('div')
        frameContainer.classList.add('iframe')
        let btn = document.createElement('div')
        btn.classList.add('btn-close')
        btn.textContent = 'X'
        btn.addEventListener('click',()=>{
            frameContainer.classList.add('hide')
        })
        frameContainer.appendChild(btn)
        frameContainer.appendChild(sender)
        document.body.appendChild(frameContainer)
    } else {
        frameContainer.classList.remove('hide')
    }
})


