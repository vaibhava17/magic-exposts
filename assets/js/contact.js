const form = document.querySelector('#contact-form-magic');

const response = document.querySelector('#response');

const responseText = document.querySelector('#response-text');

form.addEventListener('submit', async (e) => {
  e.preventDefault();

  let form = e.currentTarget;
  let url = '/auth/contact';

  try {
    let formData = new FormData(form);

    let responseData = await postFormFieldsAsJson({ url, formData });

    if (responseData.success) {
      form.reset();
      response.classList.remove('d-none');
      responseText.innerHTML = responseData.message;
      setTimeout(() => {
        response.classList.add('d-none');
      }, 5000);
    } else {
      response.classList.remove('d-none');
      responseText.innerHTML = responseData.message;
      setTimeout(() => {
        response.classList.add('d-none');
      }, 5000);
    }
  } catch (error) {
    response.classList.remove('d-none');
    responseText.innerHTML = error.message;
    setTimeout(() => {
      response.classList.add('d-none');
    }, 5000);
  }
});



async function postFormFieldsAsJson({ url, formData }) {
  let formDataObject = Object.fromEntries(formData.entries());

  if (!formDataObject.name) {
    throw new Error('Name is required');
  }

  if (!formDataObject.email) {
    throw new Error('Email address is required');
  }

  if (!formDataObject.email.includes('@')) {
    throw new Error('Email address is invalid');
  }

  if (!formDataObject.number) {
    throw new Error('Phone number is required');
  }

  let formDataJsonString = JSON.stringify(formDataObject);

  let fetchOptions = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
    body: formDataJsonString,
  };
  let res = await fetch(url, fetchOptions);
  if (!res.ok) {
    let error = await res.text();
    throw new Error(error);
  }
  return res.json();
}