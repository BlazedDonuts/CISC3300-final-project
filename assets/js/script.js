document.addEventListener("DOMContentLoaded", function() {
    const forms = document.querySelectorAll('.quantity-form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const orderId = form.querySelector('input[name="order_id"]').value;
            const currentQuantity = parseInt(form.querySelector('input[name="quantity"]').value);
            const operation = form.querySelector('button[name="operation"]:checked').value;
            
            let newQuantity = currentQuantity;
            if (operation === 'add') {
                newQuantity += 1;
            } else if (operation === 'subtract' && currentQuantity > 1) {
                newQuantity -= 1;
            }
            
            // Update quantity in database using AJAX (Fetch API)
            fetch('.', {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'update_quantity',
                    order_id: orderId,
                    quantity: newQuantity,
                    operation: operation
                })
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      // Update the quantity on the page
                      document.getElementById(`quantity-${orderId}`).textContent = newQuantity;
                  } else {
                      alert('Error updating quantity.');
                  }
              });
        });
    });
});
