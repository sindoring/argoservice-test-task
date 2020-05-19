<template>
    <v-app id="inspire">
    <v-content>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <v-card class="elevation-12">
              <v-tabs>
                  <v-tab>
                    Ввод города
                  </v-tab>
                  <v-tab @click="getData">
                    Список городов
                  </v-tab>

                  <v-tab-item>
                    <v-card flat>
                      <v-card-text>
                         <v-form>
                             <form @submit.prevent="sendData" >
                                <v-text-field
                                label="Название"
                                name="name"
                                v-model="formData.name"
                                required
                              />
                              <v-text-field
                                label="Широта"
                                name="name"
                                v-model="formData.latitude"
                                required
                              />
                              <v-text-field
                                label="Долгота"
                                name="name"
                                v-model="formData.longitude"
                                required
                              />
                              <v-text-field
                                label="Население"
                                name="name"
                                type="number"
                                v-model="formData.population"
                                required
                              />

                              <v-card-actions>
                              <v-spacer />
                              <v-btn type="submit" color="primary"
                              >
                                Отправить
                              </v-btn>
                            </v-card-actions>
                             </form>
                         </v-form>
                      </v-card-text>
                    </v-card>
                  </v-tab-item>
                  <v-tab-item>
                    <v-card flat>
                      <v-card-text>
                        <v-list v-if="items.length">
                            <v-list-group
                              v-for="item in items"
                              :key="item.id"
                              v-model="item.active"
                              no-action
                            >
                              <template v-slot:activator>
                                <v-list-item-content>
                                  <v-list-item-title v-text="item.name"></v-list-item-title>
                                </v-list-item-content>
                              </template>

                              <v-list-item
                              >
                                <v-list-item-content>
                                      <v-list-item-title v-text="`Широта: ${item.latitude}`"></v-list-item-title>
                                      <v-list-item-title v-text="`Долгота: ${item.longitude}`"></v-list-item-title>
                                      <v-list-item-title v-text="`Население: ${item.population}`"></v-list-item-title>
                                </v-list-item-content>
                              </v-list-item>
                            </v-list-group>
                        </v-list>
                        <div v-else>
                            Список городов пуст
                        </div>
                      </v-card-text>
                    </v-card>
                  </v-tab-item>
                </v-tabs>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
export default {
    name: 'CitiesForm',
    data: ()=>({
        items: [],
        formData: {},
    }),
    mounted () {
        this.getData();
    },
    methods:{
        sendData(){
            axios.post(`/api/cities`, this.formData)
                .then((res)=>{
                    console.log(res.data);
                    
                    if(res.status===201){
                        this.formData = [];
                    }
                });
        },
        getData(){
            this.isSend = false;
            axios.get(`/api/cities`)
            .then((res)=>{
                this.items = res.data;
            })
        }
    }
};
</script>
