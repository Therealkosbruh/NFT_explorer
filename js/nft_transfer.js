const tonConnectUI = new TON_CONNECT_UI.TonConnectUI({
    manifestUrl: 'http://localhost/NftExplorer_att1/market.php/tonconnect-manifest.json',
    buttonRootId: 'ton-connect'
});


import { toNano } from '@ton/ton'

async function sendNFT(){
    const transaction = {
        validUntil: Math.floor(Date.now() / 1000) + 360,
        messages: [
            {
                address: "kQD-JJEGYgM1XMnc7_vwPLholTP4k41BoHaubxyjni87XvM1",  // NFT Item address, which will be transferred
                amount: toNano(0.05).toString(),  // for commission fees, excess will be returned
                payload: body.toBoc().toString("base64") // payload with a NFT transfer body
            }
        ]
    }
    
    await tonConnectUI.sendTransaction(transaction)
}
