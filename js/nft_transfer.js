const tonConnectUI = new TON_CONNECT_UI.TonConnectUI({
    manifestUrl: 'http://localhost/NftExplorer_att1/tonconnect-manifest.json',
    buttonRootId: 'ton-connect'
});

document.addEventListener("DOMContentLoaded",function(){
    document.getElementById("close-cart").addEventListener("click", function() {
        document.querySelector(".transaction-form").classList.remove("active");
    });

    var order_btn = document.querySelectorAll(".buy_btn");

    order_btn.forEach(function(button){
        button.addEventListener("click", function(event){
            event.preventDefault();
            var orderRow = button.closest('tr');
            var orderRow = button.closest('tr');
            Nft_transfer(orderRow);
        });
    });
});

async function Nft_transfer(orderRow){
    const nftAddress = orderRow.querySelector('input[name="nft_address"]').value;
    const newOwner = orderRow.querySelector('input[name="new_owner"]').value;
    const newStatus = orderRow.querySelector('input[name="new_status"]').value;
    const imgSrc = orderRow.querySelector('.table-img').src;
    const collectionName = orderRow.querySelector('h2').textContent;
    const receiverName = orderRow.querySelector('.newrec').textContent;


    const transaction = {
        messages: [
            {
                address: "kQD-JJEGYgM1XMnc7_vwPLholTP4k41BoHaubxyjni87XvM1",
                amount: "20000000"  
            }
        ]
    };
    try {
        await tonConnectUI.sendTransaction(transaction);

        document.getElementById("nftImage").src = imgSrc;
        document.getElementById("NFTname").textContent = collectionName;
        document.getElementById("RecieverName").textContent = receiverName;
        document.querySelector('input[name="collection_address"]').value = nftAddress;
        document.querySelector('input[name="reciever_address"]').value = newOwner;
        document.querySelector(".transaction-form").classList.add("active");
     } 
     catch(e) {
         alert(e);
         alert("Ошибка оплаты, попробуйте повторить операцию."+e);
     }
}