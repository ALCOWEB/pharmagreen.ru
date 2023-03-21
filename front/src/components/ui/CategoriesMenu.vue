<template>
  <div class="col-lg-3 col-md-6">
    <div class="categories_menu">
      <div @click="show = !show" class="categories_title">
        <h2 class="categori_toggle">Все категории</h2>
      </div>
      <transition name="fade">
        <div v-if="show" class="categories_menu_toggle">
        <ul>
          <li class="menu_item_children"><a href="#">Vegetables<i class="fa fa-angle-right"></i></a>
            <ul class="categories_mega_menu">
              <li class="menu_item_children"><a href="#">Dresses</a>
                <ul class="categorie_sub_menu">
                  <li><a href="">Sweater</a></li>
                  <li><a href="">Evening</a></li>
                  <li><a href="">Day</a></li>
                  <li><a href="">Sports</a></li>
                </ul>
              </li>
              <li class="menu_item_children"><a href="#">Handbags</a>
                <ul class="categorie_sub_menu">
                  <li><a href="">Shoulder</a></li>
                  <li><a href="">Satchels</a></li>
                  <li><a href="">kids</a></li>
                  <li><a href="">coats</a></li>
                </ul>
              </li>
              <li class="menu_item_children"><a href="#">shoes</a>
                <ul class="categorie_sub_menu">
                  <li><a href="">Ankle Boots</a></li>
                  <li><a href="">Clog sandals </a></li>
                  <li><a href="">run</a></li>
                  <li><a href="">Books</a></li>
                </ul>
              </li>
              <li class="menu_item_children"><a href="#">Clothing</a>
                <ul class="categorie_sub_menu">
                  <li><a href="">Coats  Jackets </a></li>
                  <li><a href="">Raincoats</a></li>
                  <li><a href="">Jackets</a></li>
                  <li><a href="">T-shirts</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="menu_item_children"><a href="#">Fruits  <i class="fa fa-angle-right"></i></a>
            <ul class="categories_mega_menu column_3">
              <li class="menu_item_children"><a href="#">Chair</a>
                <ul class="categorie_sub_menu">
                  <li><a href="">Dining room</a></li>
                  <li><a href="">bedroom</a></li>
                  <li><a href=""> Home & Office</a></li>
                  <li><a href="">living room</a></li>
                </ul>
              </li>
              <li class="menu_item_children"><a href="#">Lighting</a>
                <ul class="categorie_sub_menu">
                  <li><a href="">Ceiling Lighting</a></li>
                  <li><a href="">Wall Lighting</a></li>
                  <li><a href="">Outdoor Lighting</a></li>
                  <li><a href="">Smart Lighting</a></li>
                </ul>
              </li>
              <li class="menu_item_children"><a href="#">Sofa</a>
                <ul class="categorie_sub_menu">
                  <li><a href="">Fabric Sofas</a></li>
                  <li><a href="">Leather Sofas</a></li>
                  <li><a href="">Corner Sofas</a></li>
                  <li><a href="">Sofa Beds</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="menu_item_children"><a href="#"> Salads<i class="fa fa-angle-right"></i></a>
            <ul class="categories_mega_menu column_2">
              <li class="menu_item_children"><a href="#">Brake Tools</a>
                <ul class="categorie_sub_menu">
                  <li><a href="">Driveshafts</a></li>
                  <li><a href="">Spools</a></li>
                  <li><a href="">Diesel </a></li>
                  <li><a href="">Gasoline</a></li>
                </ul>
              </li>
              <li class="menu_item_children"><a href="#">Emergency Brake</a>
                <ul class="categorie_sub_menu">
                  <li><a href="">Dolls for Girls</a></li>
                  <li><a href="">Girls' Learning Toys</a></li>
                  <li><a href="">Arts and Crafts for Girls</a></li>
                  <li><a href="">Video Games for Girls</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="menu_item_children"><a href="#"> Fish & Seafood <i class="fa fa-angle-right"></i></a>
            <ul class="categories_mega_menu column_2">
              <li class="menu_item_children"><a href="#">Check Trousers</a>
                <ul class="categorie_sub_menu">
                  <li><a href="">Building</a></li>
                  <li><a href="">Electronics</a></li>
                  <li><a href="">action figures </a></li>
                  <li><a href="">specialty & boutique toy</a></li>
                </ul>
              </li>
              <li class="menu_item_children"><a href="#">Calculators</a>
                <ul class="categorie_sub_menu">
                  <li><a href="">Dolls for Girls</a></li>
                  <li><a href="">Girls' Learning Toys</a></li>
                  <li><a href="">Arts and Crafts for Girls</a></li>
                  <li><a href="">Video Games for Girls</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#"> Fresh Meat</a></li>
          <li><a href="#"> Butter & Eggs</a></li>
          <li><a href="#">Milk</a></li>
          <li><a href="#">Oil & Vinegars</a></li>
          <li><a href="#"> Bread</a></li>
          <li><a href="#"> Jam & Honey</a></li>
          <li><a href="#"> Frozen Food</a></li>
          <li class="hidden"><a href="shop.html">New Sofas</a></li>
          <li class="hidden"><a href="shop.html">Sleight Sofas</a></li>
          <li><a href="#" id="more-btn"><i class="fa fa-plus" aria-hidden="true"></i> More Categories</a></li>
        </ul>
      </div>
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  name: "categories-menu",
  data() {
    return {
      show: true
    }
  },
  methods: {

  }
}
</script>

<style scoped>

</style>
