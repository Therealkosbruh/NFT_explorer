document.addEventListener("DOMContentLoaded", function() {
    var buyButtons = document.querySelectorAll(".buy_btn");
    buyButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            var nftCard = button.closest('.nft-card');
            var collectionAddress = nftCard.querySelector("[name='collection_address']").value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "market.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                }
            }
            xhr.send("buy_btn=1&collection_address=" + encodeURIComponent(collectionAddress));
        });
    });


    buyButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            var nftCard = button.closest('.nft-card');

            var imagePath = nftCard.querySelector('.tokenimg').getAttribute('src');
            var nftName = nftCard.querySelector('.nft-title').textContent;
            var nftPrice = nftCard.querySelector('.nft-price').textContent;
            var nft_descr = nftCard.querySelector(".description").textContent;
            var nft_address = nftCard.querySelector(".coladdr").textContent;

            var formNftImage = document.getElementById("nftImage");
            var formNftName = document.getElementById("NFTname");
            var formNftPrice = document.getElementById("nftprice");
            var nft_form_descr = document.getElementById("nft_form_descr");
            var collection_address = document.getElementById("collectionaddress");

            formNftImage.src = imagePath;
            formNftName.textContent = nftName;
            formNftPrice.textContent = nftPrice;
            nft_form_descr.textContent = nft_descr;
            collection_address.textContent = nft_address;
            document.querySelector(".transaction-form").classList.add("active");
        });
    });
    document.getElementById("close-cart").addEventListener("click", function() {
        document.querySelector(".transaction-form").classList.remove("active");
    });

        var NotificationBtn = document.querySelector(".notification_btn");
        var notificationContainer = document.getElementById("notificationContainer");
    
    var counter = 0;
    NotificationBtn.addEventListener("click",function(){
        NotificationBtn.classList.add("active");
        counter++;
        notificationContainer.style.display = "block";
        if (counter==2){
            notificationContainer.style.display = "none";
            NotificationBtn.classList.remove("active");
            counter=0;
        }
    });
});
