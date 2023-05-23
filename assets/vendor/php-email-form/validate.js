/**
* PHP Email Form Validation - v3.6
* URL: https://bootstrapmade.com/php-email-form/
* Author: BootstrapMade.com
*/
(function () {
  "use strict";

  // Select all forms with the class 'php-email-form'
  let forms = document.querySelectorAll('.php-email-form');

  forms.forEach(function (e) {
    // Add a submit event listener to each form
    e.addEventListener('submit', function (event) {
      event.preventDefault();

      let thisForm = this;

      let action = thisForm.getAttribute('action');
      let recaptcha = thisForm.getAttribute('data-recaptcha-site-key');

      // Check if the form action is set
      if (!action) {
        displayError(thisForm, 'The form action property is not set!');
        return;
      }
      thisForm.querySelector('.loading').classList.add('d-block');
      thisForm.querySelector('.error-message').classList.remove('d-block');
      thisForm.querySelector('.sent-message').classList.remove('d-block');

      let formData = new FormData(thisForm);

      if (recaptcha) {
        // Check if reCaptcha is loaded
        if (typeof grecaptcha !== "undefined") {
          grecaptcha.ready(function () {
            try {
              // Execute reCaptcha and get the token
              grecaptcha.execute(recaptcha, { action: 'php_email_form_submit' })
                .then(token => {
                  formData.set('recaptcha-response', token);
                  // Submit the form with the token
                  php_email_form_submit(thisForm, action, formData);
                })
            } catch (error) {
              displayError(thisForm, error);
            }
          });
        } else {
          displayError(thisForm, 'The reCaptcha javascript API url is not loaded!')
        }
      } else {
        // Submit the form without reCaptcha
        php_email_form_submit(thisForm, action, formData);
      }
    });
  });

  function php_email_form_submit(thisForm, action, formData) {
    fetch(action, {
      method: 'POST',
      body: formData,
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(response => {
        if (response.ok) {
          return response.text();
        } else {
          throw new Error(`${response.status} ${response.statusText} ${response.url}`);
        }
      })
      .then(responseData => {
        thisForm.querySelector('.loading').classList.remove('d-block');
        try {
          const responseParts = responseData.trim().split(' ');
          if (responseParts[0] === 'OK' && responseParts[1]) {
            const o_id = responseParts[1];
            thisForm.querySelector('.sent-message').innerHTML = `Your order request has been sent successfully. Thank you! Order ID: ${o_id}`;
            thisForm.querySelector('.sent-message').classList.add('d-block');
            thisForm.reset();
            console.log('o_id:', o_id); // Display o_id in the console for debugging
            // Use the o_id variable as needed in your form
          } else {
            throw new Error('Failed to retrieve a valid o_id from the response');
          }
        } catch (error) {
          displayError(thisForm, error);
        }
      })
      .catch(error => {
        displayError(thisForm, error);
      });
  }
  
  

  function displayError(thisForm, error) {
    // Display the error message and remove the loading and sent message elements
    thisForm.querySelector('.loading').classList.remove('d-block');
    thisForm.querySelector('.error-message').innerHTML = error;
    thisForm.querySelector('.error-message').classList.add('d-block');
  }

})();