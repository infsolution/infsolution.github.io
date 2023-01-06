
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Formulário de Homologação mercado pago</title>
    </head>
    <body>
        <style>
            #form-checkout {
                display: flex;
                flex-direction: column;
                max-width: 600px;
            }

            .container {
                height: 18px;
                display: inline-block;
                border: 1px solid rgb(118, 118, 118);
                border-radius: 2px;
                padding: 1px 2px;
            }
        </style>
        <form id="form-checkout">
            <div id="form-checkout__cardNumber" class="container"></div>
            <div id="form-checkout__expirationDate" class="container"></div>
            <div id="form-checkout__securityCode" class="container"></div>
            <input type="text" id="form-checkout__cardholderName" />
            <select id="form-checkout__issuer"></select>
            <select id="form-checkout__installments"></select>
            <!-- <select id="form-checkout__identificationType"></select> -->
            <input type="text" id="form-checkout__identificationNumber" />
            <input type="email" id="form-checkout__cardholderEmail" />

            <button type="submit" id="form-checkout__submit">Pagar</button>
            <progress value="0" class="progress-bar">Carregando...</progress>
        </form>

        <script src="https://sdk.mercadopago.com/js/v2"></script>

        <script>
            const mp = new MercadoPago("TEST-1478acb6-908b-476c-b7da-a3dcd5e8d5ac");

            const cardForm = mp.cardForm({
                amount: "10.00",
                iframe: true,
                form: {
                    id: "form-checkout",
                    cardNumber: {
                        id: "form-checkout__cardNumber",
                        placeholder: "Número do cartão",
                    },
                    expirationDate: {
                        id: "form-checkout__expirationDate",
                        placeholder: "MM/YY",
                    },
                    securityCode: {
                        id: "form-checkout__securityCode",
                        placeholder: "Código de segurança",
                    },
                    cardholderName: {
                        id: "form-checkout__cardholderName",
                        placeholder: "Titular do cartão",
                    },
                    issuer: {
                        id: "form-checkout__issuer",
                        placeholder: "Banco emissor",
                    },
                    installments: {
                        id: "form-checkout__installments",
                        placeholder: "Parcelas",
                    },
                    // identificationType: {
                    //     id: "form-checkout__identificationType",
                    //     placeholder: "Tipo de documento",
                    // },
                    identificationNumber: {
                        id: "form-checkout__identificationNumber",
                        placeholder: "Número do documento",
                    },
                    cardholderEmail: {
                        id: "form-checkout__cardholderEmail",
                        placeholder: "E-mail",
                    },
                },
                callbacks: {
                    onFormMounted: (error) => {
                        if (error)
                            return console.warn(
                                "Form Mounted handling error: ",
                                error
                            );
                        console.log("Form mounted");
                    },
                    onSubmit: (event) => {
                        event.preventDefault();

                        const {
                            paymentMethodId: payment_method_id,
                            issuerId: issuer_id,
                            cardholderEmail: email,
                            amount,
                            token,
                            installments,
                            identificationNumber
                        } = cardForm.getCardFormData();

                        fetch("https://info-esportes.hmldev.com.br/api/payment", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify({
                                "environment":"HML",
                                "mp_request": {
                                "additional_info": {
                                    "payer": {
                                        "first_name": "Cicero",
                                        "last_name": "Silva",
                                        "phone": {
                                            "area_code": 11,
                                            "number": "987654321"
                                        },
                                        "address": {
                                            "zip_code": "12312-123",
                                            "street_name": "Av das Nacoes Unidas",
                                            "street_number": 3003
                                        }
                                    }
                                },
                                "metadata": {
                                    "id_torneio": 10,
                                    "id_categoria": 10,
                                    "id_fatura": 10,
                                    "id_site": 10,
                                },
                                "installments": 1,
                                "issuer_id": issuer_id,
                                "payer": {
                                    "entity_type": "individual",
                                    "type": "customer",
                                    "identification": {
                                        "number": 35798469905,
                                        "type": ""
                                    },
                                    "email": "cicero.silva@w16.dev"
                                },
                                "payment_method_id": `${payment_method_id}`,
                                "token": `${token}`,
                                "transaction_amount": 10.00
                            }

                            }),
                        });
                    },
                    onFetching: (resource) => {
                        console.log("Fetching resource: ", resource);

                        // Animate progress bar
                        const progressBar =
                            document.querySelector(".progress-bar");
                        progressBar.removeAttribute("value");

                        return () => {
                            progressBar.setAttribute("value", "0");
                        };
                    },
                },
            });
        </script>
    </body>
</html>