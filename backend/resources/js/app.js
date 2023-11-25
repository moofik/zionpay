import './bootstrap';
import Router from '@/router'
import store from '@/store'
import {createApp} from 'vue/dist/vue.esm-bundler';
import { createI18n } from 'vue-i18n'

const i18n = createI18n({
    locale: 'ru',
    messages: {
        en: {
            account_number: 'Account number',
            payee_name: 'Payee\'s name',
            requisites_1: 'Open the mobile banking or payment system application. Transfer {amt} {cur}' +
                ' to the following payment details ({issuer})',
            req_attention: 'ATTENTION! After making the payment, take a screenshot of the transaction or save the ' +
                'receipt, then return to the payment form and press the PAY button.',
            amt: 'Enter USDT amount',
            email: 'Enter email',
            support: 'Support',
            payment_details: 'Payment details',
            payment_method: 'Select payment method',
            payment_details_2: 'Payment details',
            sberbank: 'Sberbank',
            tinkoff: 'Transfer by card number',
            tinkoff_1: 'Tinkoff',
            reiffeisen: 'Raiffeisen Bank',
            rshb: 'RHSB',
            bank_transfer_rus: 'Bank transfer (Russia):',
            bks: 'BKS',
            sbp: 'SBP System Fast Payments',
            payment_id: 'Your payment ID',
            payment_thanks: 'Thank you for your payment',
            receipt: 'Attach a receipt confirming the payment',
            confirmation: 'Payment confirmation',
            copy_requisites: 'Copy requisites',
            calc: 'Calculating how much RUB it will cost..',
            youllget: 'Cost: {amt} RUB',
            amt_warn: 'USDT amount should be in 50-1500 range.',
            order_processing_1: 'Processing of applications during the period 08:00-21:00 Moscow time up to 1 hour.',
            order_processing_2: 'Processing of applications from 21:00-08:00 Moscow time up to 12 hours.',
        },
        ru: {
            account_number: 'Счет получателя',
            payee_name: 'Имя получателя',
            requisites_1: 'Oткройте мобильное приложение вашего банка и переведите {amt} {cur}' +
                ' на следующие реквизиты',
            req_attention: 'Внимание! После совершения платежа сохраните чек, ' +
                'затем вернитесь в данную форму оплаты и прикрепите его (на следующем шаге).',
            amt: 'Введите сумму в USDT',
            email: 'Введите E-mail',
            support: 'Поддержка',
            payment_details: 'Платежная информация',
            payment_method: 'Способ оплаты',
            payment_details_2: 'Реквизиты платежа',
            bank_transfer_rus: 'Банковский перевод (Россия):',
            sberbank: 'Сбербанк',
            tinkoff: 'Перевод по номеру карты',
            tinkoff_1: 'Тинькофф',
            reiffeisen: 'Райффайзен Банк',
            rshb: 'Россельхозбанк',
            bks: 'БКС',
            sbp: 'Система быстрых платежей',
            payment_id: 'ID вашего платежа',
            payment_thanks: 'Платеж был успешно зарегестрирован',
            receipt: 'Прикрепите чек для подтверждения платежа',
            confirmation: 'Подтверждение платежа',
            copy_requisites: 'Скопировать реквизиты',
            calc: 'Расчет стоимости в рублях..',
            youllget: 'Стоимость: {amt} RUB',
            amt_warn: 'Сумма в USDT должна быть от 50 до 1500.',
            order_processing_1: 'Обработка заявок в период 08:00-21:00 Мск до 1 часа.',
            order_processing_2: 'Обработка заявок в период с 21:00-08:00 Мск до 12 часов.'
        },
    }
})

const app = createApp({

})

app.use(Router)
app.use(store)
app.use(i18n)
app.mount('#app')