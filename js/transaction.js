const tonConnectUI = new TON_CONNECT_UI.TonConnectUI({
    manifestUrl: 'http://localhost/NftExplorer_att1/market.php/tonconnect-manifest.json',
    buttonRootId: 'ton-connect'
});

async function transaction(){
    let priceElement = document.getElementById("nftprice").textContent;
    
    if (!priceElement) {
        alert('Элемент с ID "nftprice" не найден.');
        return;
    }

    let priceString = priceElement.replace(/[^0-9.]/g, '').trim();
    if (!priceString) {
        alert('Значение цены не определено или равно 0.');
        return;
    }
    
    let payment_price = parseFloat(priceString) * 1000000000;
    if (isNaN(payment_price)) {
        alert('Преобразование цены в число не удалось.');
        return;
    }

    let payment_priceBigInt = BigInt(Math.round(payment_price));
    if (!payment_priceBigInt) {
        alert('Преобразование цены в BigInt не удалось.');
        return;
    }

    const transaction = {
        messages: [
            {
                address: "0QD7xTXSW8JX1u912sf69JXNXnBeAg1mRHGS_YoXy8ZXqk1X",
                // amount: payment_priceBigInt.toString()
                amount: "20000000"  
            }
        ]
    };
    try {
       await tonConnectUI.sendTransaction(transaction);
       window.location.href = 'http://localhost/NftExplorer_att1/confirmation.php';
    } 
    catch(e) {
        alert(e);
        alert("Ошибка оплаты, попробуйте повторить операцию."+e);
    }
}

