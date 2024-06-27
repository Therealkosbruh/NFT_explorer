const tonConnectUI = new TON_CONNECT_UI.TonConnectUI({
    manifestUrl: 'http://localhost/NftExplorer_att1/tonconnect-manifest.json',
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
                address: "0QDeAgG1txqri6ZkYNY_bizlSR1DprJf7EM-YumHS9xeeuNt",
                amount: "2000000000"  
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

async function discon(){
    await tonConnectUI.disconnect();
}
