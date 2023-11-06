<template>
  <section class="h-100 gradient-form">
    <div :class="{'container-md': true, 'py-5': !isWidget, 'pb-2': isWidget, 'pt-4': isWidget, 'h-100': true}">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div :class="{'rounded-3': true, 'text-black': true, 'card-background': true, 'row': true}">
            <div class="support text-end me-4 col-sm">
              <a href="https://t.me/zion_admin" target="_blank" class="btn button-support btn-block fa-lg me-2 gradient-custom-2">{{ $t('support') }}</a>
              <button :class="{'btn': true,
               'button-support': $i18n.locale !== 'en',
               'button-support-active': $i18n.locale === 'en',
               'btn-block': true, 'fa-lg': true, 'me-2': true, 'gradient-custom-2': true}"
                      @click="enLocale">EN
              </button>
              <button :class="{'btn': true,
               'button-support': $i18n.locale !== 'ru',
               'button-support-active': $i18n.locale === 'ru',
               'btn-block': true, 'fa-lg': true, 'me-2': true, 'gradient-custom-2': true}"
                      @click="ruLocale">RU
              </button>
            </div>
          </div>

          <div class="row g-0">
            <div class="col-lg-12">
              <div class="card-body p-md-5 mx-md-4">
                <section class="section-form">
                  <div class="section-form-stepper">
                    <div class="step" :class="{'step-active' : step === 1, 'step-done': step > 1}">
                      <svg
                          xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink"
                          width="25px" height="25px">
                        <image  x="0px" y="0px" width="25px" height="25px"  xlink:href="data:img/png;base64,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" />
                      </svg>
                    </div>
                    <div class="step" :class="{'step-active' : step === 3, 'step-done': step > 3}">
                      <svg v-show="step<2"
                          xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink"
                          width="25px" height="25px">
                        <image  x="0px" y="0px" width="25px" height="25px"  xlink:href="data:img/png;base64,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" />
                      </svg>
                      <svg v-show="step>=2"
                          xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink"
                          width="25px" height="25px">
                        <image  x="0px" y="0px" width="25px" height="25px"  xlink:href="data:img/png;base64,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" />
                      </svg>
                    </div>
<!--                    <div class="step"-->
<!--                         :class="{'step-active' : step === 4, 'step-done': step > 4}">-->
<!--                      <svg v-show="step<3"-->
<!--                          xmlns="http://www.w3.org/2000/svg"-->
<!--                          xmlns:xlink="http://www.w3.org/1999/xlink"-->
<!--                          width="25px" height="25px">-->
<!--                        <image  x="0px" y="0px" width="25px" height="25px"  xlink:href="data:img/png;base64,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" />-->
<!--                      </svg>-->
<!--                      <svg v-show="step>=3"-->
<!--                          xmlns="http://www.w3.org/2000/svg"-->
<!--                          xmlns:xlink="http://www.w3.org/1999/xlink"-->
<!--                          width="25px" height="25px">-->
<!--                        <image  x="0px" y="0px" width="25px" height="25px"  xlink:href="data:img/png;base64,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" />-->
<!--                      </svg>-->
<!--                    </div>-->
                  </div>

                  <div class="col-12" v-if="Object.keys(validationErrors).length > 0">
                    <div class="alert alert-danger">
                      <ul class="mb-0">
                        <li v-for="(value, key) in validationErrors" :key="key">{{ value[0] }}</li>
                      </ul>
                    </div>
                  </div>

<!--                  <div class="col-12" v-show="alertOfAmount">-->
<!--                    <div class="alert alert-dark">-->
<!--                      {{$t('amt_warn')}}-->
<!--                    </div>-->
<!--                  </div>-->

                  <h2 v-show="step===1" class="col widget-step-new" v-if="isWidget">{{$t('payment_details')}}</h2>
                  <transition name="slide-fade">
                    <form v-show="step===1" action="javascript:void(0)" id="with-checks" @submit.prevent="nextWithChecks"
                          :class="{'row': true, 'col-10': !isMobile, 'col-12': isMobile, 'm-auto': true}" method="post">
                      <div :class="{'widget-form-font': isWidget, 'widget-form': true}">
                        <div :class="{'form-outline': true, 'mb-4': !isWidget, 'mb-3': isWidget}">
                          <label for="amount" class="col-sm-12 control-label">{{$t('email')}}</label>
                          <input type="email" name="email" v-model.trim="user.email" id="email" class="form-control" required/>
                        </div>

                        <div :class="{'form-outline': true, 'mb-4': !isWidget, 'mb-3': isWidget}">
                          <label for="issuer" class="col-sm-12 control-label">{{$t('payment_method')}}</label>
                          <select required name="issuer" id="issuer"
                                  class="form-select" v-model="issuer">
                            <option value="" disabled>
                              {{$t('bank_transfer_rus')}}
                            </option>
                            <option selected value="Tinkoff Bank">
                              {{$t('tinkoff')}}
                            </option>
                          </select>
                        </div>

                        <div v-show="issuer !== null && donation_type !== null" :class="{'form-outline': true, 'mb-4': !isWidget, 'mb-3': isWidget}">
                          <label for="amount" class="col-sm-12 control-label">{{ $t('amt', {currency: this.currency})}}</label>
                          <input type="number" step="0.000000001" placeholder="50 USDT - 1500 USDT" name="amount" v-model.number="amount" id="amount" class="form-control"/>
                        </div>
                        <h4 class="usdt-amt" v-show="loadTokenAmount && !alertOfAmount">{{$t('calc')}}</h4>
                        <h4 class="usdt-amt" v-show="!loadTokenAmount && !alertOfAmount && rubAmt !== null">{{$t('youllget', {amt: this.rubAmt})}}</h4>
                        <h4 class="usdt-amt" v-show="alertOfAmount">{{$t('amt_warn')}}</h4>
                      </div>


                      <div class="text-center pt-1 mb-5 pb-1">
                        <button v-show="amount !== null" type="submit" :disabled="loadTokenAmount"
                                :class="{'en': this.$i18n.locale === 'en', 'ru': this.$i18n.locale === 'ru'}"
                                class="button-next btn btn-block fa-lg gradient-custom-2 mb-3">
                          <svg
                              xmlns="http://www.w3.org/2000/svg"
                              xmlns:xlink="http://www.w3.org/1999/xlink"
                              width="10em" height="4em">
                            <image  x="0px" y="0px" width="10em" xlink:href="data:img/png;base64,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" />
                          </svg>

                        </button>
                        &nbsp;
                      </div>
                    </form>
                  </transition>

                  <h2 v-show="step===paymentRequisitesStep" class="col widget-step-new requisites-step-new" v-if="isWidget">{{$t('payment_details_2')}}</h2>
                  <transition name="slide-fade">
<!--                    <form v-if="step===paymentRequisitesStep" action="javascript:void(0)" @submit.prevent="next"-->
<!--                          :class="{'row': true, 'col-10': !isMobile, 'col-12': isMobile, 'm-auto': true, 'widget-form-font': isWidget}" method="post">-->
                    <form ref="addImageForm" v-show="step===paymentRequisitesStep" action="javascript:void(0)"
                          @submit.prevent="pay"
                          :class="{'row': true, 'col-10': !isMobile, 'col-12': isMobile, 'm-auto': true, 'widget-form-font': isWidget}" method="post">
                      <div :class="{'form-outline': true, 'requisites-widget-container': isWidget}">
                        <Requisites v-bind="requisitesProps"></Requisites>
                      </div>
<!--                      <div class="text-center pt-1 mb-5 pb-1  ">-->
<!--                        <button type="button" @click="prev" :disabled="processing"-->
<!--                                class="button-prev btn btn-block fa-lg gradient-custom-2 mb-3">-->
<!--                          <svg-->
<!--                              xmlns="http://www.w3.org/2000/svg"-->
<!--                              xmlns:xlink="http://www.w3.org/1999/xlink"-->
<!--                              width="4em" height="4em">-->
<!--                            <image  x="0px" y="0px" width="4em" xlink:href="data:img/png;base64,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" />-->
<!--                          </svg>-->
<!--                        </button>-->
<!--                        &nbsp;-->
<!--                        <button type="submit" :disabled="processing"-->
<!--                                :class="{'en': this.$i18n.locale === 'en', 'ru': this.$i18n.locale === 'ru'}"-->
<!--                                class="button-next btn btn-block fa-lg gradient-custom-2 mb-3">-->
<!--                          <svg-->
<!--                              xmlns="http://www.w3.org/2000/svg"-->
<!--                              xmlns:xlink="http://www.w3.org/1999/xlink"-->
<!--                              width="10em" height="4em">-->
<!--                            <image  x="0px" y="0px" width="10em" xlink:href="data:img/png;base64,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" />-->
<!--                          </svg>-->

<!--                        </button>-->
<!--                      </div>-->
                      <div class="text-center pt-1 mb-5 pb-1 payment-button-container">
                        <button v-show="!processing" type="button" @click="prev" :disabled="processing"
                                class="button-prev btn btn-block fa-lg gradient-custom-2 mb-3">
                          <svg
                              xmlns="http://www.w3.org/2000/svg"
                              xmlns:xlink="http://www.w3.org/1999/xlink"
                              width="4em" height="4em">
                            <image  x="0px" y="0px" width="4em" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHcAAABmCAYAAADxsw60AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAABmJLR0QA/wD/AP+gvaeTAAAAB3RJTUUH5woEAi823GV39gAAIFNJREFUeNq9nX2wbnVVxz/r4QAC9woqBCKKYnpFMwqhxEQURdNJzZcyRc4ZaExzQCM1pz88x3PGmglHvOqYb5meo5hSitqESKn4kmiAiIqCJIqRgCAClysJl7v647df1m/91trP6Z/2DDzn2fv3st7Xd629n32F9VUAUAURUEAYz9lDpP6u3f9EzFiZgT4W+B3gMYg8Ejgc1S2I7Ifqfav11M23e/TX/DHuZWh1dPe8VBcNP/26nsf0kJFXO2+g3Vz310Ye7gB2ononcB0i30f1SkT+HeXbCLsreXh9eHrnyG+hYdYu5Cf7hUd57QE8A5GXoPoM4MBYGZsUbL9nRHQ1RTvmJZ5Xze/nSs1jpaDke7txoOR2SEDbfVF6434E8DSz1y2ofBb4CKqfReTewWgiw48UbWUwKLeydG0tLlqknD8QkTNQ/RPgkEmBZcpzBIVHZgzVHtqu33jXIHGzp/FwS4M3kMhjI0VWsgrGC7XCxusHAieDnAzcCLwXkXcAt1TWGBmujRzmmNXMGyYirxkZ3AdYA34ILIMcEgom1pQzEHLFWuKtQXijUA3mJAqz8/qBWRrye3ij9NpVLz+8M9TreKMZ+T0EWEb1h6iuobqvM4SWN1qHWRi0vtlcJ/JMkHcBhzehfBTOLYhchOrXUP0eIj9AuaXLNb8cJqidJy2BVU4NFEhiRJm3RRYfCSpKC3bd7O/M28exeyOyBdUDUX04IkcCj0fkyfSprJ63BXgDqovAKxE5fy5GMLQLH3zjKCicZdQT9kb1rYi8wqjTMvhz4MPAOcAlqO5OE34WXptrLj9ma8zz/FDZFgBZS0vWDOlLjMkryX+36a9cmwHHInIyqi8F7teuj4JuR+T1qN5T6SyRr7C+Om2B5Xgg8Cng2EpoZfGbEDkbeBewoxaEEVqNqOt8NL13fj5UKG7tAOk0aSEwiGZc4rHN/nM8PULXtcK3An+K6p8DBze0qF4CPBe4YV6VMWuIay12G6oXA8e6vLMLdDvwSFTPQnVHypRVUI2yc1Blc6cPb5OhKQEwEZbocUa0pt0rSl2ZQv351Bg9oBr23AGcBfJIRLYXOWNz9bHAxcC2UN7m+6xN6hWxj0Dki5Q61eQhfojqcYicicgdFTOVAQTM9uv7ksvyXIEgM88bgzrFVKVHoEgLcipwlCjAAjjB8RYYWgR4sjAeAi07lztQPRM4jgJc7bqHI3JRp59AxmXPWRvuhjh1GKqfpw8No1DPRzgauLQSmmTeESjLK9XvH9XWvbdH+w3AynlDZTG0iq4tqvXQeVGiocMuF6SRqrHijGDgsTGYS4GjQc6vDUEPAT4PHBYQ1ilXqS26rLAXIp/oFGxnfZAS72+LhUjgLY4Rqwxv9f5771WSKC+KEIOCiIUrtF7TyyOKNp4eb3TW6yrtuvWt3HXC2OJS6zaE53byt8Z3GKqfQHWvxoFEmI1CqBT0N6ge6/LMB1A9bcgBVmCeUK9oy7xHipXgjTK9Qn0h789V57Wlx0eTKfqj8BuFWLu2j0hxKRQYZpLLW8yyC+U04ANOZsd2+mr2agEVPBN4tZPCp1F9mRNL6xXzrqWe4UMkQVSIEDS1IrIQ6sO3rZ2zxoBvXPjPNK8m5c+UAquIRcKHgKDAy4BPu/VeDTyrVvCg3IGRfRF5D6p25rXAInBvJZAI2FhhNkAjsFyv0EghkdFkXtmEYHHLT4CfhibitbOOmOfFd9KGT5nmySrTtknHKfcCi6hea9YWRN6NyL7jOtordwh9r0f1wYbpXcAfArfP7eRY4hvluOspIKJd25+zazZtyGTsnNI4RtUae3GmcPvpDT7quHlZDmsaI8nwgertwItQ3WVk+2Dg9ZaHmVn8ANBXO7bfDlyWhtwM7VoGO56aGtdfr5iEMIw1CNes20cHbzA+ovjQGnlrBpCnulbRPo2iXT6PDMHTGUWp8nkpIm93xL4a5IAxLI8Eno7I/mbgjYi8MbToyEOysKgTyvbn50rXXMqUb6OHnaOBYP06g1ISpVl6s+bElFFmoX2iVq2jRJMSVoAbDT37I5zRR4CuzmUBkdPdZm/BthPHi0BiTb1gM8Kj8OdD9FQ4HrYPSqhKgB5lJyg39FpnHFNG5MuXyIiy0N3w5fiP5jY3VrgTkbe49U5HZAEGQKVPRznYbHYrqu8mPALmo7BsBe+L+inhTgm/KqkCAXoFWC/01yzt/pytzSNPtUZceXdk7NQIuLK7JDVM9QDaCPRu4GdGtr8CPB0dABWnGM5B9UPAnbWQyJnwimiErbEiM0VH1t4oS/L9IwH1vEWAMJqntMZTKcWtm3mqnTjU+LSGZXHGZkL+qJM7EfmwO38KCDNUZ4icNOZBBTinzonJBplCojIDCRhy6Dr0EGJLrgRGrYAITUf3hptSCWNIEY/B/KlGRbOX5SfWXyiHKbmW8+e4tPB0hNkMkaOABwybityM7RtbpqY6LVXIdeHMMuYNIbsrExlQmI+8EIfBo6L9Pk1pQ6yYykCc8gcl2ThrjGtYR4J1u4GVwhKj8AqOrotcCvzE5OT7A0fNUD2+Ehx8ARENywXvJSnqdMYQ6c1bv4f/YddH4nVsnevrW18b+70t/U3Z4RQYlSyNsD3AszxE8jJ0T4GuqCyylqL6BZe/j58BR7qBF6e1lQ2F88KRF5JvMngGIsPxAqqETT1uaAAkChw8LClHIrr8HpHAoyNTuq33PRDz0SDruuVY41JXPx+5ADzSEXR1xbz34CpMue8ZKu2J8N6VCWKq0VDtR723BsaXhkPa65HCsxItG5fxEV2r5DJVVpq0EpWTZd7VlVxEts2Ah1QWA9dUISNj1D8paYmP8rJ//jZC1FOHD9lVyI2Eli40zk/RrSEpK0lCmQTjIyPzQDOSSYXIJwx9lMk1ThYPniGy1QnmhjRcVEROWHEkLCERYGAkGUqO1o6Y9bWqFZ7Qzs2wg6+RJ40hOR+lmwpXJIBy3vf23A3u2tYZsNWd3Jm2yUKqzfcI7Xl0GgnLe3h6nzY4MiFHLTxPjz+fIvZAoA0vwVhfJWR0pzmdxKOdIZVzOx3PWxcot/nqxXz4zABWqnhiwxiK9UA4/nc/XgCRJYd1s+HDz4vIbbBElM+YRrTV+DkeFinLy9YCxKn8PXWo7rsQJvMGzbmyIgI7KbOZwIyiM4CzGXDT1KwJ2rVoOsuFkVIyAxpo1tyQI7onkXByTMl2Yu9ZGrr6c7YBEOXGKNFbImxoyUDUIHjaPSLGQuUHoW2IREapnsxI8PbaVE3scUQUMSJZRYcHolPoO2qMBONn1YUpS8rCQibsDEHbc1mtHJVQmfAiNOtBlf09kA/9ldAjBSbKsg2aqoGRKC77uwnHHZFTNbQE5+wa3TE+2joFKKwQphBsGOrmrDl1NMZmhGfLtf7avMbKvHAYYgG7R6CU5tcM7g8Piioauv8qJff/CU1knMI+DSi1N+snE7W1qoqDevFhkwm0a5WThUCvlKybY1OGmaOLy1vSSOO7XvNAoSU6q3PDPZzyrYdXNAQRLZRDAG5DEDZ69qwRqhW0taaKmUQIFbpMAIa/lhHZCJjWioOmiC6tLABH6uLySSDo4vJB1T5TIM0Lbqp8azzKRi5Ld89PkG6m+GycJHCciHbzvX20NRlYbRDVkFGeDMsRjcdN5dCsXLDCG+cdQLk//VZdWj4NeJwurdwvVMhmEG4kE09LR0bMZyaLzEgsPdFeCXIPZD2rhJrVYD7+2529tVvrnULTtibN8qM/QmTbhN6XAH8EPAb4K+Dx2J9cpLViDEqqcxGYDEsbnW8cEqxhQVXTA5jQQaQvke61CZupFa3wq7DRhyTHxFBT9hqkFsSwDmYd8n2bsIWjBXRp5QTglcBB3dVDgPsDO9L8WzUfgpQwGJ8Q5mmrjDCaBWnMr+Fl69OgLeuG8d3/wr3Ltdlk+eOV0Ywxiky7Vzq9fv9QUYooab3A2sOo2KMpT95vMztcC3yR8uYY4iM578GUL6EqLwuUEdFsr9tFo4ZMz5tPS5VcZUKmsNB4llfssGmgqKxWtURaL0+ZdHtmDZFEWLq4vI0Sjp/qZm2X9dWPh0i8Ut5Ers0aL9H1sF9AnXrsdR/Sq2gY5NbmXjWtrMzeC2NkjcAP9SbVuyx6hRnZZOEoUnxNUaBggsOE/x4dLy4/FHgW8HswvAZoN/Be4G9rYSTepH7vLP1QG26l88Qwfa72OTZSTJ+qfES0so1KK+fp42+FLIHDhIwhG6oCjxrkEYC1SIAhE5HB1Mzo4vJhwNOAFzGG43uATwBny8bavZXgovKm398Dv6BuHKJPlr68Mm3OrpQ+gXESXtsoQUuD43MhzW12oCc0Cive+ryAopLG/x2F+GGc+XNxWSgPGZxA+ZHab3eX7ga+Avw9/a/RK5oSUJTJoOHNKMbTGynAR6HqeiCLtCx0ICtLf47uBfwxZZmeuV7oXmlhLg7AUkRkZCSDJwu6uLwAHAE8hZJnj+9G/Q/wLeAfgEtlfXXXuHZH6FTXyqYaawBTXhoBo4anhGerTK+0UE6S09SsUb63t/xkjmWGCxrBeEFUwiO1snBfJyhdWrkP8GsUj/0DRo+9C7gK+Bhwoayv3uwIiZF4WF/PUWpEZ8/+VPcrza/GuyNE7yPfvDFGBwupRW2GwIrJCQsLUSH5voHwdGnlAMrLQp9I+YH4Ud2lHZQQ/FHgk7Kx9uNmvcxwsvJoqgKIDq+gJoLJxH6b8OqpVJimhOjFnj7xD2BnSrFMe2S3Wbs+NCElCFW6tHIo8DxKCP5N+ic24efAlcD5wLmyvvqjgW7bixVig82U6hXj72f3/PRimQqTPTlswlCiki2j0efbJuWIa2LU1NRMReg3IiwCEZV2nUFosAagi8t7A+jSyjbgL4FTgScZxf438HXgQ8A5srE2KtYi7Z5u/18kPNs8GPg0Mmk6cBrLpKnxE+Vksou8OKK9ipjeOLR7m02zeWCldrIPPRGsF7+mxISbmxG6uLxnp9iDgcN0cflJwDuB0yilzgO7SZcDnwHeA/yTrK+aUBwYkD8agza0Ra89AHRpWTpjk7Bz5JUV5fS0NHI0+egZ0ZylTvM5s8JNhZH9Si86qlpXamVHRHfE6dLK/sABurRyFPAC4MWU3wg/FdgH2NKNvrRT6qdkY+2Tsr56a9el6g1jofvsPb//3LP7nOnisqD23PI+3Zwt3Zj9u+/369LCgbK+qrq0crBsrGmXJtDF5YeAjArv+Z/EEc4AMoVZMQ1rTlyv1pDu0gffqM5qZBi0GbCTdXAaIoKat5urS8t7UELuYylg6b7AocBDawvjbuAvKLf1Pg48CLgG+C2KNz+u+zwG+F633pXAb3TnjwO+CjwZ+BxwEiVfPxv4JOUdW58BngFcREHlF1PuLF1ByfffNese3c37rmys3fN/6gHYw5ZqVsZedgMGcuPH/aqJwcu0LRghWiCmbiq/RAoezgHFM18KnNgpdAf189S7KG9j/wUl5z6vo/3FnXJOotwgON4o41udMr5DQdbfpryY9DJKCfXE7vMJ3fgndEZwIvBw4HcptwqfS/kV5E5gP0oHbC9Ki3PvjtYrU0Dp30SQtTdDr/XGYXXgU0KP1o1KWF9V1wmpd5lCxaGFMTIzRag5r4vLRwP/gn/beq3chU6w2gn3HmBPwgL7//X4APDHsr6qjYLmGbs6bVg5VZ/Uis0+odKlexIjAElThbsFSv28vjTw/0WMFsUK8Cjg1gkBLlA8ZU+KYrX7e1fH9t3duF92n3d1nzu7z/6Nsrd3n/1efbPjp8lnf/1nbl7//Tbgl7Kxpk2FELUaG4X3yH4ipamSKj47uiqh7i1HXZbo8Ja0mbF+85FRAf6L0oR4DiVf9iHQHrspIfURlPdAnApcQAmfF1DakV+k5N9vAI+m5MVfpfxy8WHADyity6soT2pcQcmf3+3G/SfwYOB6ypvLb6OkjF2Ul3vtRTGQrZ2CDwUu1MVlkfVVHfhtFOXAatQBtPP6MVmf2V6bKE/HJkaWY4fPJk/WISPNzXauqUFtKCkg5w5KTv0qBag8ivIURR9dZsCPOsV/GvgCpYlxIaVD9c8Uj/soowfPKD3nvSjv+NjSKWy/7vt9KF6+leKVD+gM7SGdordRcvfRlJr68cCXKZ2yiyhI/rOVRLOecqQAC4ysXKLHZyJlZ+XTUArZtllVLDvrk2yRKIxExtEx4sCErK+qbKzdKxtrV1Dy7hrw1k54V3VK7xV1FMVzTgS+IOurl8jG2kcoaPXjwLdlffV84HJZX/0ccJmsr34Z+Iasr34duEw21i4DLpeNtW8AV8j62uXd+e8A/yHrq9cCX5P11euBr3R96s/LxtptwIWysbZT1lcvlI21u2V99TOyvrZb1te0UYIksqiFFcvOOkuq0AD3WHAl0pVCNWExoBoW1NiS5vWMI4RoGXRWrovLT6bcq300BeX2D7ld1yn4H4H3y/rqDcP8SHbVNkF08oLJPC1LQRngtF6ZAU8J9rAyTo3CyXUcq3Y/90/PWCsxC1jdZorPmI/uaAxdsIRoVWRj7SLK7buPABuU56EADqfkzdOBP9OllUc1EWcANJYOahqypoNXWBTFagZjA8F5WZjuaA1fgnNenk0HzOmqu+56y76molZM1mHyShwsMEOJjhBvHGPIvpKS4z4MnE0BQFBy5/0ptfFpurj8mKrJXynGKjExpqxTNNDkjNgakVeGVUBmMEOOneOVwzxp14xauI7GWbNYpuzGkrJwZPNGwKznZ8rjRZCNtZuAH1O8eJXSpIBSCh0EvBA4WReXHzt6SxItNlUNT4Rh304NG/4EHh6An7Bb564P8k2tsqXZ0D1rrCBsdgc5ICuBorIq6rJU0J5aMLZeBGR9dScFWH0K+GvgS0bBhwG/D7xQl1YeNW7uBBWFX8ufpzOTS8WjtkYbicXL0BpC5o2Rwv3fUYlp9pg1F/3AkCi7EaO3WIatZYdlUn/NKNyXBWb+8NhMKX22U3rDvYL7luTTdXH5QePchPFIeFFEagw7EPQwH+eRZtxQzuMMTQMvpZ2TKd8O9mmI+pW8rYdakJVZv40Mlnkfehoik7Cnftx4TTbWdlMaCp+n/CNVFzD2nR9L+RnJif2doOapRp2gzYdxL4/G6JyBNHTbdRkVaQFRpCjrHNmP3iv9ODoM/fWNA7/BQJizKO9ZFfPBRpEH+2OqvDJlRafg23Vx+UuUxv3elJsAe1Lu+txNeSPPvw1NE98p8nwmxtSkj6mH8ocxXn6x4Js9QgUn+X8KTZv1Z2nv1y8SCcgj6YpQ44VTHtzMw8w3ezqPko21mym591xKF6kP2ycAr9ellcc03uINLlKo59vprakCLB9+Hb9AFB0jZU2h9wbAmVKtKYU8g4EFNN99yI4EY8NKJLxI2JUh6VxGZWPteuBfKfd2b6b0n6E0P87QpZWHhHOb6BDwm5Zqrn6OUlnYzIlwilvDllmRzK3sfMT048JSaF6nxo5F43mWF+/ZkdVvpuMVCV9B1ld/0Cn3PEbvhXJj4RRdWtm3qXcrHpzgs1yIGx4ZdVqH+uuaO1SDeQJaplKcOT+rJvgmRarUOYLwNaVbNrVOKwQP5vprFQCiR9LfpzxrZZv4e1GaHYeE+4Rl2kT5UR0JPc0wVx9V8syMghoIRmvPo7Pbp/6HGisFJXyFbbQASUcoslKgWy+so5O0YEuv7rusr34XeB+lo3UP5QmN84F7QjAS1ZwZQPLzfFqJjNOj7KyxUcnO8ZwBqSwquNPtz0m8JaQWaYj2YbUKsdoqI4sIITOdIJow6OkTKDXwAZT7udspt/F+0QrGRQaL9C0dQb2dyir0Mkm+B8bty8Nsvyw8+6ig/sfXmWVOokfLKK1yGus0wsp+9u+BlS2m1V+3m3MP5QG31e4B9TtlfW1XW2445RGsaSPPVERqMIXlxcvTKdbzHoXbtNIIxkAlrvrpx7KAVBtmgKexIiO0eaAsCiuNoUzUlEMEa+tDXVrZQ9ZX7w3nRUd0PbC7tCYO08kEL5au6Ps8WqfXqB73mYWDotabJ65RlCuN5oGXSDAWaEU4YBgb1Ivdd9lYuzfNiXO9Uc36gUCzOtMLPFrbyzVT2hRAC7GRlaGNTAUt/2LTba2M6PIHVc6w46YMpjGeIDKkdTixR/mQZekYanCmjdcLejOlTqi0ZK3oVQ1R/d/oxe7j51X8/mKG6o6qywH7pQtHDFpr90rPOitZzemRa6QAXy82zRPHpDeGzLAywBaF3dBbqI14+O74avJ+YJhJaVNVEF7mqvs5w9gxQ2THwExZ9IGT4TNskwW1myfK5ksv2MoAGAWS5bl0nitXmoe9vZEFSssM0Y6v+KI+n1UaNp1U5x0/Pe9e3pEB2kkiD3Ql3p0zVH/sPOcRjWKzRG49pbGqYK7lJiqd0tca0HqMVZ711irvJXnLlmnhMVEthEbg1o4MsAm5LkJEBjGVY30EK4/82uPHM+D7zuq2hQrM6q9oXIVqg7wZhbqpXGi9ozIa7wlzwErUC/cP1fu51foBoPJpIQqrdi0b9iNvnyerCHCVMdvc2KtnlB9MWUKPC0sZby1RDvaHQBhKIgMJGyCO2ciDBi9w9aP3bFvXVgoiUJhbx+81adw4hQey8zxV1wOZTjVKRuM4xsn2qgVKu84S+BREBDUraPe/MMw6C/PEDAw6D6qIDdbxgvGCrITv1rDbeNqD8qlJBxHo8/RZbOBpjHiu1nV7TlUl9lyGxsvvu54yomlA+PIM5ApEbjXMHITqMZMe2WwQfPdhtR40fthwbIVu50VWHu2RgZmp9054+qoxzqs8OPN8V14cMF7xpTEtdj97eM+uAd0xqB46Rg5uBb45Q9iN6oXOm06uhTEhmEipmadN1bRZzem9LfTASgpOMWafqLzyeXLwBgsUvRId+TVKbcsdr5As+nkjicrJIe9XxnKy8+4Lgd39Lb8PVRISOQWRLeZEDKwiYOGtzRMZoc9IOPM6NB7oDNcD5O7XbsChV2IEiAj2o6YnKmGsQiJ+mhTj+PdAzKikG7cFeKkbcw6qw/uWLwRuMsTdH3jFuKERrEXAU7kpkpPPrZkXTq05z6imPKOvfjLD8jm+AnmObkuP3zcqedrnUOuxljdvkF4WlXHLy1F9gOHlp8AFiAzPUO1C5J1ukdd0VuGEFTCTtdmaciVRWsWQBRwSG9AU8m4UIG7twCO8R0Z7TYZS6r18SrO6jbpoPhT7hxQ8b+PYLQivrdZVfSequ0bPLdb8DlRvNwscgshq2xiwjLr8UiFFau9qinhiCx3CpBNyg5yJhRMBG+uhm2kMzCsBG4H39CXKmKr1o3E9GAvzeHWsUr+N4Hbg7f3Y2bCYyG2IvM1ZyKsQeVyDHu0D5Z7QEP2O+k9Djw3JYYiz+ztBpk0RF6K9V0W5rQpSAeDLqggJaJkXdTI07SNek3cF4BhUX+XWfBvl98edcmtiz6L8+Lg/FlA9F5H9B4FGAGSKcdso8M3yQdmM61rGm9CkgdKdV0YgJaIvmm+NxmMBfzuzqlndml4u/rov9fpol8pP6v2F/RH5GP2bEcr561E9y64/PtpaBL2TAqTUEHMEsAGyR5PHIqvzQg3z5LhMpdRKOUE5EAGZiIbMk5sWXrLOFKJuFEbsnZaXKBpF6aNnOwzlwxp7FH1whBmnwMsZ3wHSKddaURl4PvB2R9RzKG8el8rirDAipXqFRt7RCDxQtK0nIwOKjM0TmjU+ppo1EW1pt8gZ1VQp5/mr5BKURiMvArwP5Tmu8ngHcL7nJX6GqrzI65J6E05D9e+AParba1nbzAIrn4c90Vnta63WhtZGcAHK7UXhSx8v5Ox8Vn+GPDgaohTVgL56Ss17uyTCHsD7gVOHyWXOpcDrmtAu4v5doXHjuxF5PiLXOys8DTgPYf8KvYYAiRhkWEZtSTDkr4n8Exb0AdquQFOgrEiBHo33a88rhQZ6Aq+d3DOIQsN6NWuUN+qdh+qpjq7rUX0eqncP441DzWIvApTrUT0RuMkp5tnA5aDHVIQ1yghyrbVKK5heOEP6cMAq28crL/Jq207M0GeDmE2qyrBFkyICxUdlYHXerRnXuMeg+k2UZ4/rKMCNwIkg1ze1+lAKVTUrNWMi1yByAuUlIxblPozyC/ezUd0aen8UliKlDzxkeSpSqjs36V3SKqnJjVLvE+XD6Hu/vjeKkG/qdTwfQ9UwjNuK6tmdnB9W/VJD5DpUnwxyTSU3h+LHVxU1Qh8IvhqRJ9Dn4NFyFhA5szOA1wJb05w2MOWY6ZWXNRimakpbF1dK8+vYUsvRE+XYeVVAhJY3fXhcYuQ8pqgtwGtRvQY4E1X3wnO9BHgCIldXJWkg17GJETE0CuAniByP6lvpn40dGTwY1Tejeh2q2ylvcBN8CPT7eO/wOXxKwMN8Ws+K2otRqRW1PCNa7FqeCXWGk3W/hvlpqSad3LZT3v/xZkQOdmMV2I7I8cBPxrWD9bq/hQ++MchjrsazoUv1mR30fngt9EqIt1De8HYxcBWq1wI3g+xE+GUYtr0ymzqTNsKk4zKwYuYj7VrR37USpo3NX2tp3Jvy9rqDEDmC8pa844CnUF5HGMtB+QFwBsJn2hIz+a6KsL5aXwgfa+jOjYvsA7wO1dcgct+0SG+8sFknN6Y0ZycKaJSXCDhaK6MlfcQjOKYEPsVbWEoOYOsOygvF34xyVwjAsvmoBVQ9gYFwqnJOQfUuVNcQORx4A/DTJm96Ikbpt+E66uHacQPBgTArciPAkyg0azj4dmcWcisUnNEWAC2fFirFDGj4p6i+AeVwVNdQvavKz1NGZPTV/pv1nvhegE0YFYDbUN4EHAbyfFTPBX5WKToURiLkilFzvS95omaHEBhR4EU+ikShNqNtqsnR59LMYCNE7+ks8v0ZwrmovgA4DJE3Idw2lnHEtHmZmb0X0lLIM5E2yBXgHoTzQM7rDObXgSeieiTlkcvDUbaAbgG2VMRsNn9lR294VUkTMJ3l+UipNiSHHbHAQLJOXX3uTkTupLwx9jqEq0G+h+pXUL4F7B729elMrDGo+5twv/8FmoDn+TpseKQAAAAASUVORK5CYII=" />
                          </svg>
                        </button>
                        &nbsp;
                        <button v-show="!processing" type="submit" :disabled="processing"
                                :class="{'en': this.$i18n.locale === 'en', 'ru': this.$i18n.locale === 'ru'}"
                                class="button-next-2 btn btn-block fa-lg gradient-custom-2 mb-3">
                          <svg
                              xmlns="http://www.w3.org/2000/svg"
                              xmlns:xlink="http://www.w3.org/1999/xlink"
                              width="10em" height="4em">
                            <image  x="0px" y="0px" width="10em" xlink:href="data:img/png;base64,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" />
                          </svg>
                        </button>

                        <div class="payment-processing-container" v-show="processing">
                          <span class="payment-processing">Происходит оплата, пожалуйста подождите </span>
                          <pulse-loader :style="'display: inline-block;'" :loading="processing"></pulse-loader>
                        </div>
                      </div>
                    </form>
                  </transition>

<!--                  <h2 v-show="step===paymentConfirmationStep" class="col widget-step-new" v-if="isWidget">{{$t('confirmation')}}</h2>-->
<!--                  <transition name="slide-fade">-->
<!--                    <form ref="addImageForm" v-show="step===paymentConfirmationStep" action="javascript:void(0)"-->
<!--                          @submit.prevent="pay"-->
<!--                          :class="{'row': true, 'col-10': !isMobile, 'col-12': isMobile, 'm-auto': true, 'widget-form-font': isWidget}" method="post">-->

<!--                      <div class="confirmation-form-inner">-->
<!--                        <strong class="d-block pb-4">{{$t('receipt')}}:</strong>-->
<!--                        <input required type="file" ref="fileupload" class="form-control" v-on:change="onFileChange"/>-->
<!--                      </div>-->

<!--                      <div class="text-center pt-1 mb-5 pb-1">-->
<!--                        <button v-show="!processing" type="button" @click="prev" :disabled="processing"-->
<!--                                class="button-prev btn btn-block fa-lg gradient-custom-2 mb-3">-->
<!--                          <svg-->
<!--                              xmlns="http://www.w3.org/2000/svg"-->
<!--                              xmlns:xlink="http://www.w3.org/1999/xlink"-->
<!--                              width="4em" height="4em">-->
<!--                            <image  x="0px" y="0px" width="4em" xlink:href="data:img/png;base64,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" />-->
<!--                          </svg>-->
<!--                        </button>-->
<!--                        &nbsp;-->
<!--                        <button v-show="!processing" type="submit" :disabled="processing"-->
<!--                                :class="{'en': this.$i18n.locale === 'en', 'ru': this.$i18n.locale === 'ru'}"-->
<!--                                class="button-next-2 btn btn-block fa-lg gradient-custom-2 mb-3">-->
<!--                          <svg-->
<!--                              xmlns="http://www.w3.org/2000/svg"-->
<!--                              xmlns:xlink="http://www.w3.org/1999/xlink"-->
<!--                              width="10em" height="4em">-->
<!--                            <image  x="0px" y="0px" width="10em" xlink:href="data:img/png;base64,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" />-->
<!--                          </svg>-->
<!--                        </button>-->

<!--                        <div class="payment-processing-container" v-show="processing">-->
<!--                          <span class="payment-processing">Происходит оплата, пожалуйста подождите </span>-->
<!--                          <pulse-loader :style="'display: inline-block;'" :loading="processing"></pulse-loader>-->
<!--                        </div>-->
<!--                      </div>-->
<!--                    </form>-->
<!--                  </transition>-->


                  <transition name="slide-fade">
                    <div v-show="step===paymentConfirmationStep">
                      <h2 class="col widget-step-new thank-you-step">{{ $t('payment_thanks') }}</h2>
                      <p v-show="payment_id" :class="{'p-4': !isWidget, 'donation-description': true, 'donation-description-mb': !isWidget}">
                        {{$t('payment_id')}}: {{this.payment_id}}
                        <br/>
                        <!--Payment details and information about your account have been sent to your email address.-->
                      </p>
                      <div class="text-center pt-1 mb-5 pb-1">
                        <button :disabled="processing" @click="toAuthorizedPayment"
                                :class="{'en': this.$i18n.locale === 'en', 'ru': this.$i18n.locale === 'ru'}"
                                class="button-next-3 btn btn-block fa-lg gradient-custom-2 mb-3">
                          <svg
                              xmlns="http://www.w3.org/2000/svg"
                              xmlns:xlink="http://www.w3.org/1999/xlink"
                              width="12em">
                            <image  x="0px" y="0px" width="12em"  xlink:href="data:img/png;base64,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" />
                          </svg>
                        </button>
                      </div>
                    </div>
                  </transition>

                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import {mapActions} from 'vuex'
import Requisites from "@/components/Payment/Requisites.vue";

let controller = new AbortController();

function debounce(fn, wait) {
  let timer;
  return function (...args) {
    if (timer) {
      clearTimeout(timer); // clear any pre-existing timer
    }
    const context = this; // get the current context
    timer = setTimeout(() => {
      fn.apply(context, args); // call the function if time expires
    }, wait);
  }
}

import PulseLoader from 'vue-spinner/src/PulseLoader.vue'

export default {
  name: 'register',
  components: {Requisites, PulseLoader},
  data() {
    return {
      alertOfAmount: false,
      usdt: null,
      loadTokenAmount: false,
      steps: {},
      step: 1,
      donation_type: 1,
      currency: null,
      issuer: 'Tinkoff Bank',
      amount: null,
      rubAmt: null,
      payment_id: null,
      file: null,
      user: {
        phone: "",
        email: ""
      },
      validationErrors: {},
      processing: false,
      paymentCompleted: false,
      firstTime: true,
      isWidget: false,
      isDebug: false,
      external_id: null,
      trc20: '',
      ongoingRequest: false
    }
  },
  methods: {
    ...mapActions({
      signIn: 'auth/loginWithoutRedirect',
      signOut: "auth/logout"
    }),

    ruLocale() {
      this.$i18n.locale = 'ru'
    },

    enLocale() {
      this.$i18n.locale = 'en'
    },

    async logout() {
      await axios.post('/api/logout').then(({data}) => {
        this.signOut()
        this.toAuthorizedPayment()
        this.firstTime = true
      })
    },

    toAuthorizedPayment() {
      this.steps = {}
      this.step = 1
      this.currency = 'RUB'
      this.issuer = null
      this.amount = null
      this.file = null
      this.payment_id = null
      this.validationErrors = {}
      this.processing = false
      this.paymentCompleted = false
      this.firstTime = false
      this.$refs.addImageForm.reset()
      this.$refs.fileupload.value = null
      this.external_id = null
      this.usdt = null
      this.loadTokenAmount = false
    },

    onFileChange(e) {
      this.file = e.target.files[0];
    },

    asset(path) {
      let base_path = window._asset || '';
      return base_path + path;
    },

    prev() {
      this.step--;
    },

    next() {
      this.step++;
    },

    nextWithChecks() {
      const value = this.amount

      if (value !== undefined && (value < 50 || value > 1500)) {
        this.alertOfAmount = true;
        return;
      }

      this.alertOfAmount = false;
      this.step++;
    },

    async pay() {
      this.processing = true
      await axios.get('/sanctum/csrf-cookie')

      const config = {
        headers: {'content-type': 'multipart/form-data'}
      }

      let formData = new FormData();
      formData.append('file', this.file);
      formData.append('payment_method', this.issuer);
      formData.append('payment_amount', this.amount);
      formData.append('email', this.user.email);

      if (typeof this.trc20 === 'string' || this.trc20 instanceof String) {
        formData.append('trc20', this.trc20);
      }

      if (this.currency) {
        formData.append('currency', this.currency);
      }

      await axios.post(this.url, formData, config).then(({data}) => {
        this.validationErrors = {}
        this.payment_id = data.payment_id
        this.paymentCompleted = true;
      }).catch((data) => {
        if (data.response.status === 422) {
          this.validationErrors = data.response.data.errors
        } else {
          this.validationErrors = {}
          alert(data.data.message)
        }
      }).finally(() => {
        this.processing = false
      })

      if (Object.keys(this.validationErrors).length === 0) {
        this.step++;
      }
    }
  },
  watch: {
    async amount(newValue, oldValue) {

      if (this.ongoingRequest) {
        controller.abort()
        controller = new AbortController()
        this.ongoingRequest = false
      }

      if (newValue !== null && newValue > 0) {
        this.loadTokenAmount = true;
      }

      if (newValue !== undefined && newValue !== null && (newValue < 50 || newValue > 1500)) {
        this.alertOfAmount = true;
        return;
      } else {
        this.alertOfAmount = false;
      }

      this.debouncedFetch(newValue, oldValue);
    }
  },
  computed: {
    isMobile: function () {
      return window.screen.availWidth <= 540
    },
    paymentRequisitesStep: function () {
      return 2;
    },
    paymentConfirmationStep: function () {
      return 3;
    },
    paymentThanksStep: function () {
      return 4;
    },
    url: function () {
      return '/api/payment-anonymous';
    },
    requisitesProps: function () {
      let qrAssetDemo = this.asset('/images/1.png')
      let data = null;

      switch (this.issuer) {
        case "Kasikorn Bank":
          data = {
            number: '161-8-74206-3',
            name: 'CRYSTAL X CO., LTD.'
          }
          break;

        case "True Wallet":
          data = {
            number: '161-8-74206-3',
            name: 'CRYSTAL X CO., LTD.'
          }
          break;

        case "Sberbank":
          data = {
            number: '2202 2013 3064 4069',
            name: 'Денис И.'
          }
          break;

        case "Tinkoff Bank":
          data = {
            number: '2200-7001-7704-5027',
            name: 'Анна Анатольевна Ч.'
          }
          break;

        case "Raiffeisen Bank":
          data = {
            number: '2200-3001-0026-6285',
            name: 'Иван Васильевич Д.'
          }
          break;

        case "RSHB":
          data = {
            number: '6234-4620-0496-7615',
            name: 'Антон Олегович Г.'
          }
          break;

        case "BKS":
          data = {
            number: '2203-6203-2094-5609',
            name: 'Антон Олегович Г.'
          }
          break;

        case "SBP":
          data = {
            number: '+79871050858',
            bank: 'СБЕРБАНК',
            name: 'Денис И.'
          }
          break;

        case "ЮMoney":
          data = {
            number: '0x5ff12b5b19168ef4c06cabda2dca0bd3bb426148',
            name: 'Елена Александровна Г.'
          }
          break;

        case "Jusan Bank":
          data = {
            number: '5395-4515-0779-8087',
            name: 'ANTON GIRENKO'
          }
          break;

        case "Halyk Bank":
          data = {
            number: '5522-0433-4789-3339',
            name: 'ANTON GIRENKO'
          }
          break;

        case "Kaspi.kz":
          data = {
            number: '4400-4302-3150-3027',
            name: 'ANTON GIRENKO'
          }
          break;

        case "BCC.KZ":
          data = {
            number: '4628-1888-8673-4679',
            name: 'ANTON GIRENKO'
          }
          break;

        case "Bereke Bank":
          data = {
            number: '4263-4333-4563-2738',
            name: 'ANTON GIRENKO'
          }
          break;

        case "Ziraat Bank (TRY)":
          data = {
            number: 'TR03 0001 0090 1040 7797 2050 01',
            name: 'Pavel Tikhonov'
          }
          break;

        case "Ziraat Bank (USD)":
          data = {
            number: 'TR73 0001 0090 1040 7797 2050 02',
            name: 'Pavel Tikhonov'
          }
          break;

        case "Ziraat Bank (EUR)":
          data = {
            number: 'TR46 0001 0090 1040 7797 2050 03',
            name: 'Pavel Tikhonov'
          }
          break;

        case "MayBank (USD)":
          data = {
            number: '5104-8111-0723-3797',
            name: 'ANTON GIRENKO'
          }
          break;

        case "MayBank (IDR)":
          data = {
            number: '5104-8131-0255-9432',
            name: 'ANTON GIRENKO'
          }
          break;

        case "BNB":
          data = {
            number: '9112-3980-1040-9153',
            name: 'MAKSIM SABLIN'
          }
          break;

        case "EGRIP":
          data = {
            number: '3001909330011728/9153',
            name: 'BY44BLNB30143001909330011728'
          }
          break;

        case "Binance Pay":
          data = {
            number: 'ID: 21552799'
          }
          break;

        case "Bitcoin":
          data = {
            number: '15buBy2NmK1aVaq5dgA5a7tXFicqRw7E91'
          }
          break;

        case "Ethereum ERC20":
          data = {
            number: 'x5ff12b5b19168ef4c06cabda2dca0bd3bb426148'
          }
          break;

        case "Telegram Wallet":
          data = {
            number: '@mixpay_support'
          }
          break;

        case "USDT Tether BEP20":
          data = {
            number: '0x5ff12b5b19168ef4c06cabda2dca0bd3bb426148'
          }
          break;

        case "USDT Tether TRC20":
          data = {
            number: 'TRHt4mxa39BwzgmwdBjS7hCqaF67JWqptA'
          }
          break;

        case "USDT Tether ERC20":
          data = {
            number: '0x80079a4937e2b89e564030d3a9aaf87ae14d1996'
          }
          break;

        default:
          data = {
            reqimage: qrAssetDemo
          }
      }

      data['issuer'] = this.issuer
      data['currency'] = this.currency
      data['amount'] = this.rubAmt

      return data
    }
  },
  created() {
    let isWidget = this.$route.query.widget
    this.trc20 = this.$route.query.trc20
    let isDebug = this.$route.query.debug
    document.getElementById('custom-body').style.backgroundColor = '#091013';
    //document.getElementById('custom-body').style.backgroundSize = '50%';

    if (isWidget === undefined) {
      this.isWidget = false
    }

    if (isWidget === 'true') {
      this.isWidget = true
    }

    if (isDebug === undefined) {
      this.isDebug = false
    }

    if (isDebug === 'true') {
      this.isDebug = true
    }

    this.debouncedFetch = debounce(async (newValue, oldValue) => {
      let url = `/api/convert?amount=${this.amount}`;
      this.ongoingRequest = true;

      await axios.get(url, {signal: controller.signal}).then(({data}) => {
        this.ongoingRequest = false;
        this.loadTokenAmount = false;
        this.rubAmt = data.result;
      }).catch(({data}) => {
        if (data.status === 422) {
          this.loadTokenAmount = false;
          this.validationErrors = data.data.errors
        } else {
          this.validationErrors = {}
          alert(data.data.message)
        }
      })
    }, 1000);

    window.parent.postMessage("loaded", '*');
  },
}
</script>

<style lang="scss">

@font-face {
  font-family: "Montserrat";
  src: url('fonts/static/Montserrat-Regular.ttf');
  font-weight: 400;
  font-style: normal;
}

@font-face {
  font-family: "Montserrat";
  src: url('fonts/static/Montserrat-Bold.ttf');
  font-weight: 700;
  font-style: normal;
}

@font-face {
  font-family: "Montserrat";
  src: url('fonts/static/Montserrat-SemiBold.ttf');
  font-weight: 600;
  font-style: normal;
}

@font-face {
  font-family: "Montserrat";
  src: url('fonts/static/Montserrat-Bold.ttf');
  font-weight: 600;
  font-style: normal;
}

@font-face {
  font-family: "Montserrat";
  src: url('fonts/static/Montserrat-Thin.ttf');
  font-weight: 100;
  font-style: normal;
}


* {
  font-family: Montserrat, sans-serif !important;
}

.card {

}

.payment-processing-container {
  display: flex;
}

.payment-processing {
  margin-top: -0.15em;
  margin-right: 10px;
  color: #4c9f81;
  font-size: 1em;
}

.gradient-custom-2 {
  /**
   *
   */
}

.usdt-amt {
  font-size: 0.9em;
}

.widget-logo-container {
  margin-bottom: 2em;
}

body {
  overflow-x: hidden !important;
}

.widget-logo {
  width: 100%;
}

.usual-logo {
  width: auto;
}

.btn.btn-primary {
  margin-top: 1em;
  border: 2px solid black;
}


.donation-description-mb {
  margin-bottom: 3em;
}

.donation-type-select {
  max-width: 100%;
  white-space: normal;
  /* For Firefox: */
  text-overflow: ellipsis;
}

.widget-step-name {
  margin-left: 2em;
  border: 0.05em solid black;
  padding: 0.7em;
  border-radius: 8px;
  font-size: 1.2em;
  color: rgba(121, 113, 113, 0.99);
}

.requisites-widget-container {
  font-size: 1.2em;
}

.requisites-widget-container p {
  margin-bottom: 0 !important;
}


.row {
  .logo, .support {
    width: auto;
  }

  .support {
    margin-top: 2.1em;
  }
}

@media (min-width: 300px) and (max-width: 499px) {
  .widget-logo {
    width: 50%;
  }

  .row .support {
    margin-top: 0.2em;
  }



  .donation-description-mb {
    margin-bottom: 0;
  }

  .logo .text-logo {
    font-size: 0.9em;
  }

  .widget-form-font {
    font-size: 0.9em;
  }

  h2.widget-step-new {
    width: 80%;
    margin: 1em auto;
  }
}

@media (min-width: 500px) and (max-width: 768px) {
  .widget-logo {
    width: 50%;
  }

  .row .support {
    margin-top: 0.2em;
  }

  .donation-description-mb {
    margin-bottom: 0;
  }

  .logo .text-logo {
    margin-bottom: 2em;
    margin-top: -1.5em;
  }

  .logo .text-logo.mini-margin-top {
    font-size: 1em !important;
  }

  .widget-form-font {
    font-size: 1em;
  }

  h2.widget-step-new {
    width: 80%;
    margin: 1em auto;
  }
}

@media (min-width: 769px) {
  .widget-logo {
    width: 20%;
  }

  .row .support {
    margin-top: 0;
  }

  .donation-description-mb {
    margin-bottom: 0;
  }

  .gradient-custom-2 {
    border-top-right-radius: .3rem;
    border-bottom-right-radius: .3rem;
  }

  .payment-info {
    width: 600px;
  }

  h2.widget-step-new {
    width: 80%;
    margin-top: 1em;
    margin-bottom: 1em;
  }
}

@media (min-width: 300px) and (max-width: 769px) {
  .row .logo {
    width: 30%;

    img {
      width: 100%;
    }
  }

  .card-background {
    margin-bottom: 1em;
  }
}
$brand-primary: #ff6400;
$brand-secondary: #dedc00;
$brand-lemon: #fff219;
$brand-quaternary: #f282a5;
$brand-menthol: #c3500a;
$brand-coral: rgb(250, 90, 85);
$brand-paprika: rgb(205, 0, 125);
$color-white: #fff;
$color-dark: #676767;
$color-gray: #cecece;
$color-lightgray: #ededed;
$color-jungle: #193805;

/* FONT */
$font-montserrat: "Montserrat", sans-serif;
$font-weight-bold: 700;

.logo .text-logo.mini-margin-top {
  margin-top: -0.2em;
  font-size: 0.5em;
}

.pen-description {
  display: flex;
  flex-flow: column;
  align-items: center;
  font-family: $font-montserrat;

  h1 {
    text-align: center;
    margin-top: 2rem;
    color: $color-white;
  }

  p {
    margin: 0;
    line-height: 1;
  }

  .pen-copyright {
    img {
      border-radius: 25px;
      padding: 5px;
      margin: 5px;
      transition: box-shadow .5s ease-in-out;
    }

    &:hover img {
      box-shadow: 0 10px 20px #0e2101;
    }
  }
}

.section-form {
  h2 {
    text-align: center;
    color: white;
    line-height: 1.2;
    font-weight: 500;
    font-size: 34px;
    margin-bottom: 40px;
  }

  &-stepper {
    display: flex;
    justify-content: space-between;
    width: 100%;
    position: relative;
    margin: 0 auto 1.5em;

    &::before {
      z-index: 0;
      content: "";
      display: block;
      position: absolute;
      height: 2px;
      top: calc(50% - 1px);
      background: repeating-linear-gradient(to right, transparent, transparent 2px, white 5px, white 5px);
      width: calc(100% - 20px);
    }

    .step {
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 2;
      color: $color-gray;
      border-radius: 50%;
      min-width: 25px;
      min-height: 25px;
      line-height: 20px;
      font-size: 16px;

      &-active {
        color: $brand-primary;
        background-color: transparent;
        border: 1px solid black;
        height: 45px;
        border-radius: 50%;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        width: 45px;
      }

      &-done {
        color: #ff9f5a;
        border-color: #ff9a4f;
      }

      &-number {
        font-family: $font-montserrat;
        font-weight: 800;
        line-height: 1;
        vertical-align: middle;
      }
    }
  }

  // Transition SLIDE FADE
  .slide-fade-enter-active {
    transition: all 0.4s ease-out;
  }

  .slide-fade-leave-active {
    display: none;
    transition: all 0.4s cubic-bezier(1, 0.5, 0.8, 1);
  }

  .slide-fade-enter-from, .slide-fade-leave-to {
    transform: translateX(10px);
    opacity: 0;
  }
}

.tokens-amt, h4.loading {
  font-size: 1.5em !important;
}

span[class^="dot-"] {
  opacity: 0;
}

.dot-one {
  animation: dot-one 2s infinite linear
}

.dot-two {
  animation: dot-two 2s infinite linear
}

.dot-three {
  animation: dot-three 2s infinite linear
}

.card-background {
  background: none;
  justify-content: space-between;
}


.widget-form {
  background: #4c9f81;
  opacity: 0.9;
  border-radius: 20px;
  padding: 2em;
  color: white;

  .form-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-color: white;
    background-repeat: no-repeat, repeat; /* Отключаем повторение фона для изображения стрелки */
    background-position: right 0.75em center, 0 0; /* Позиция изображения стрелки и фона */
    background-size: 15px auto, auto; /* Размер изображения стрелки и фона */
    //border: 1px solid #ccc;
    //padding: 5px 30px 5px 10px;
    //border-radius: 4px;
    position: relative;
    cursor: pointer;
  }

  input {
    background-color: white; /* Два фона */
    background-repeat: repeat; /* Отключаем повторение фона для изображения стрелки */
    background-position: 0 0; /* Позиция изображения стрелки и фона */
    background-size: auto; /* Размер изображения стрелки и фона */
  }
}

.button-support {
  background: #4c9f81;
  color: #ffeadc;
  font-size: 0.8em;
  padding: 0.7em 2em;
}

.button-support:hover {
  background: #306d57;
  color: #ffeadc;
  font-size: 0.8em;
  padding: 0.7em 2em;
}

.button-support-active, .button-support-active:hover {
  background: #144626;
  color: white;
  font-size: 0.8em;
  padding: 0.7em 2em;
}

.button-next {
  position: relative;
  opacity: 0.9;
}

.en.button-next::after {
  position: absolute;
  content: 'Next';
  font-size: 1.2em;
  right: 4em;
  top: 1em;
}

.ru.button-next::after {
  position: absolute;
  content: 'Далее';
  font-size: 1.2em;
  right: 4em;
  top: 1em;
}

.button-next::before {
  position: absolute;
  right: 0.8em;
  top: 2.1em;
  content: '';
  background: url('/images/arrow-next.png') no-repeat center center/cover;
  padding-right: 1.5em;
  padding-bottom: 1.5em;
}

.button-next-2 {
  position: relative;
  opacity: 0.9;
}

.ru.button-next-2::after {
  position: absolute;
  content: 'Оплатить';
  color: black;
  font-size: 1.2em;
  right: 3em;
  top: 1em;
}

.en.button-next-2::after {
  position: absolute;
  content: 'Pay';
  color: black;
  font-size: 1.2em;
  right: 4em;
  top: 1em;
}

.button-next-2::before {
  position: absolute;
  right: 0.8em;
  top: 2.1em;
  content: '';
  background: url('/images/arrow-green-dark.png') no-repeat center center/cover;
  padding-right: 1.5em;
  padding-bottom: 1.5em;
}

.button-next-3 {
  position: relative;
  opacity: 0.9;
}

.ru.button-next-3::after {
  position: absolute;
  content: 'Новый платеж';
  color: #f5e0d1;
  font-size: 0.9em;
  right: 2.2em;
  padding: 0 2em;
  top: 1.8em;
}

.en.button-next-3::after {
  position: absolute;
  content: 'Make another payment';
  color: #f5e0d1;
  font-size: 0.9em;
  right: 2em;
  padding: 0 2em;
  top: 1em;
}

.button-next-3::before {
  position: absolute;
  right: 1em;
  top: 2.6em;
  content: '';
  background: url('/images/arrow-next.png') no-repeat center center/cover;
  padding-right: 1.5em;
  padding-bottom: 1.5em;
}

h2.widget-step-new {
  border: 0.1em solid #4c9f81;
  padding: 0.5em;
  border-radius: 20px;
  color: white;
  font-size: 1em;
}

input[type=file] {
  border: 1px solid #9e4d14;
  border-radius: 1em;
}

input[type=file]::file-selector-button {
  margin-right: 20px;
  background: #4c9f81;
  padding: 10px 20px;
  border-radius: 10px;
  color: #fff;
  cursor: pointer;
  transition: background .2s ease-in-out;
}

input[type=file]::file-selector-button:hover {
  background: #e84803;
}

.confirmation-form-inner {
  color: white;
  background: linear-gradient(to right, #6dae97, #50947b 50%, #3ea57f 75%);
  padding: 3em;
  border-radius: 2em;
}

.payment-button-container {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;

  .button-next-2 {
    font-size: 12px;
  }
}

@media (min-width: 540px) {
  .section-form .widget-step-new {
    width: 40%;
    margin-top: 1em;
    margin-bottom: 1em;
    margin-left: 10% !important;
  }

  .section-form .widget-step-new.requisites-step-new {
    margin-left: 20% !important;
  }
}

.section-form .widget-step-new.thank-you-step {
  margin: 1em auto;
  width: 80%;
}

.donation-description {
  color: #ffeadc;
  background: #4c9f81;
  border: 10px;
  margin-top: 1em;
  border-radius: 5em;
  padding: 1.7em 2.5em 1.7em 2.5em;
  font-size: 1em;
  position: relative;
  width: 100%;
}

.tournament-description {
  font-size: 1em;
  font-weight: 600;
  text-align: center;
}
@keyframes dot-one {
  0% {
    opacity: 0;
  }
  15% {
    opacity: 0;
  }
  25% {
    opacity: 1;
  }
  100% {
    opacity: 1;
  }
}

@keyframes dot-two {
  0% {
    opacity: 0;
  }
  25% {
    opacity: 0;
  }
  50% {
    opacity: 1;
  }
  100% {
    opacity: 1;
  }
}

@keyframes dot-three {
  0% {
    opacity: 0;
  }
  50% {
    opacity: 0;
  }
  75% {
    opacity: 1;
  }
  100% {
    opacity: 1;
  }
}


</style>