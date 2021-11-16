<template>
    <!-- Modal -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Измененить : {{ editType }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div v-if="editType=='Запись'" class="modal-body">
                    <div class="row mx-auto">

                        <div class="col-12 ">
                            <label for="hours">Количество часов (часов)</label>
                            <input type="number" step="0.5" v-model:value="record.hours" class="form-control" id="hours" required>
                        </div>

                        <div class="col-12 mt-3">
                            <label for="per-hour">Стоимость часа (грн/час)</label>
                            <input type="number" class="form-control" v-model:value="record.perHour" id="per-hour" required>
                        </div>

                        <table class="p-3 my-5 table table-striped table-hover">
                            <tr class="bg-primary">
                                <td colspan="2"><h5 class="text-light">Итоговые значения</h5></td>
                            </tr>
                            <tr>
                                <td>Количество часов</td>
                                <td class="text-end">{{ record.hours }} часов</td>
                            </tr>
                            <tr>
                                <td>Стоимость в час</td>
                                <td class="text-end">{{ record.perHour }} грн/час</td>
                            </tr>
                            <tr>
                                <td>Итого</td>
                                <td class="text-end">{{ record.perHour*record.hours }} грн</td>
                            </tr>
                            <tr>
                                <td>Зарплата</td>
                                <td class="text-end">{{ record.perHour*record.hours/2 }} грн</td>
                            </tr>
                            <tr>
                                <td>Прибыль студии</td>
                                <td class="text-end">{{ record.perHour*record.hours/2 }} грн</td>
                            </tr>
                        </table>
                    </div>
                    <button class="btn btn-success" @click="$root.saveRecord(record)" data-bs-dismiss="modal">Сохранить</button>
                </div>

                <div  v-else-if="editType=='Сведение'" class="modal-body">

                        <label for="price" class="form-label">Стоимость (грн)</label>
                        <input type="number" class="form-control" id="price" v-model:value="mixing.price">

                    <table class="p-3 my-5 table table-striped table-hover">
                        <tr class="bg-primary">
                            <td colspan="2"><h5 class="text-light">Итоговые значения</h5></td>
                        </tr>
                        <tr>
                            <td>Итого</td>
                            <td class="text-end">{{ mixing.price }} грн</td>
                        </tr>
                        <tr>
                            <td>Зарплата</td>
                            <td class="text-end">{{ mixing.price/2 }} грн</td>
                        </tr>
                        <tr>
                            <td>Прибыль студии</td>
                            <td class="text-end">{{ mixing.price/2 }} грн</td>
                        </tr>
                    </table>

                    <button class="btn btn-success" @click="$root.saveMixing(mixing)" data-bs-dismiss="modal">Сохранить</button>

                </div>

                <div v-else-if="editType=='Урок'" class="modal-body">
                    <label for="profit">Выручка с урока (грн)</label>
                    <input type="number" class="form-control" id="profit" v-model:value="lesson.profit">

                    <table class="p-3 my-5 table table-striped table-hover">
                        <tr class="bg-primary">
                            <td colspan="2"><h5 class="text-light">Итоговые значения</h5></td>
                        </tr>
                        <tr>
                            <td>Итого</td>
                            <td class="text-end">{{ lesson.profit }} грн</td>
                        </tr>
                        <tr>
                            <td>Доля Вани</td>
                            <td class="text-end">{{ lesson.profit/2 }} грн</td>
                        </tr>
                        <tr>
                            <td>Прибыль студии</td>
                            <td class="text-end">{{ lesson.profit/2 }} грн</td>
                        </tr>
                    </table>

                    <button class="btn btn-success" @click="$root.saveLesson(lesson)" data-bs-dismiss="modal">Сохранить</button>

                </div>

                <div v-else-if="editType=='Ролик'" class="modal-body">
                    <label for="rolik-price">Стоимость ролика (грн)</label>
                    <input type="number" class="form-control" id="rolik-price" v-model:value="rolik.price">
                    <label for="exspense">Затрата на диктора (грн)</label>
                    <input type="number" class="form-control" id="exspense" v-model:value="rolik.exspense">
                    <table class="p-3 my-5 table table-striped table-hover">
                        <tr class="bg-primary">
                            <td colspan="2"><h5 class="text-light">Итоговые значения</h5></td>
                        </tr>
                        <tr>
                            <td>Итого</td>
                            <td class="text-end">{{ rolik.price }} грн</td>
                        </tr>
                        <tr>
                            <td>Затраты на диктора</td>
                            <td class="text-end">{{ rolik.exspense }} грн</td>
                        </tr>
                        <tr>
                            <td>Зарплата Вани</td>
                            <td class="text-end">{{ (rolik.price-rolik.exspense)/2 }} грн</td>
                        </tr>
                        <tr>
                            <td>Прибыль студии</td>
                            <td class="text-end">{{ (rolik.price-rolik.exspense)/2  }} грн</td>
                        </tr>
                    </table>

                    <button class="btn btn-success" @click="$root.saveRolik(rolik)" data-bs-dismiss="modal">Сохранить</button>

                </div>

                <div v-else-if="editType=='Арранжировка'" class="modal-body">
                    <label for="arrangment-price">Стоимость арранжировки (грн)</label>
                    <input type="number" class="form-control" id="arrangment-price" v-model:value="arrangment.price">
                    <label for="arrangment-exspense">Затраты на арранжировку (грн)</label>
                    <input type="number" class="form-control" id="arrangment-exspense" v-model:value="arrangment.exspense">
                    <table class="p-3 my-5 table table-striped table-hover">
                        <tr class="bg-primary">
                            <td colspan="2"><h5 class="text-light">Итоговые значения</h5></td>
                        </tr>
                        <tr>
                            <td>Итого</td>
                            <td class="text-end">{{ arrangment.price }} грн</td>
                        </tr>
                        <tr>
                            <td>Затраты на арранжировку </td>
                            <td class="text-end">{{ arrangment.exspense }} грн</td>
                        </tr>
                        <tr>
                            <td>Зарплата Вани </td>
                            <td class="text-end">{{ (arrangment.price-arrangment.exspense)/2 }} грн</td>
                        </tr>
                        <tr>
                            <td>Прибыль студии</td>
                            <td class="text-end">{{ (arrangment.price-arrangment.exspense)/2  }} грн</td>
                        </tr>
                    </table>

                    <button class="btn btn-success" @click="$root.saveArrangment(arrangment)" data-bs-dismiss="modal">Сохранить</button>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "editModal",
    props:{
        editType:String,
    },
    data:()=>({

        flagRequired:0,
       record:{
           hours:1,
           perHour:300
       },
        mixing:{
            price:600
        },
        lesson:{
           profit:50
        },
        rolik:{
           price:0,
           exspense:0,
        },
        arrangment:{
           price:900,
           exspense:0,
        },
    }),
    methods:{

    }
}
</script>

<style scoped>

</style>
