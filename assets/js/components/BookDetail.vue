<template>
  <b-card
    id="book-detail"
    :tag="isEditMode ? 'form' : 'div'"
    @submit.prevent="submit"
  >
    <template v-slot:header>
      <div v-if="!isEditMode">
        <span class="icon-top" title="Edit">
          <b-icon icon="pencil" @click="isEditMode = true" />
        </span>
        <h4 v-if="!isEditMode" class="mb-0">{{ book.title }}</h4>
      </div>
      <div v-if="isEditMode">
        <span class="icon-top" title="Abort">
          <b-icon icon="backspace" @click="isEditMode = false" />
        </span>
        <b-form-input v-model="book.title" size="sm" />
      </div>
    </template>
    <div v-if="!isEditMode">
      <div>
        Author:
        <strong v-text="book.author.firstName" />
        <strong v-text="book.author.lastName" />
        #{{ book.author.id }}
      </div>
      <div>
        Published at
        <strong>
          {{ book.publicationDate | formatDate('ddd DD MMM YYYY') }}
        </strong>
      </div>
      <div>
        ISBN:
        <strong v-text="book.ISBN" />
      </div>
      <div>
        Categories:
        <b-badge
          v-for="(cat, catKey) in book.categories"
          :key="catKey"
          pill
          variant="info"
          :title="cat['@id']"
          v-text="cat.name"
        />
      </div>
    </div>
    <div v-if="isEditMode">
      <div>
        Author:
        <strong v-text="book.author.firstName" />
        <strong v-text="book.author.lastName" />
        #{{ book.author.id }}
        <vue-bootstrap-typeahead
          size="sm"
          v-model="authorSearch"
          :data="availableAuthors"
          :serializer="(i) => i.lastName"
          @hit="book.author = $event"
        />
      </div>
      <div>
        <label for="book_publicationDate">Published at</label>
        <b-form-datepicker
          id="book_publicationDate"
          v-model="book.publicationDate"
        ></b-form-datepicker>
      </div>
      <div>
        ISBN:
        <b-form-input v-model="book.ISBN" size="sm" />
      </div>
      <div v-if="availableCategories">
        Categories:
        <b-form-checkbox-group id="boo_categories" v-model="bookCategoriesIds">
          <b-form-checkbox
            v-for="cat in availableCategories"
            :key="cat['@id']"
            :value="cat['@id']"
            >{{ cat.name }}</b-form-checkbox
          >
        </b-form-checkbox-group>
      </div>
      <div>
        <b-btn type="submit">Save</b-btn>
      </div>
    </div>
    <!-- <pre v-text="JSON.stringify(book, null, '\t')" /> -->
  </b-card>
</template>

<script>
import http from '../http';

export default {
  name: 'BookDetail',
  props: {
    book: {
      type: Object,
      default: null,
    },
  },
  mounted() {
    this.computeBookCategoriesIds();
  },
  data() {
    return {
      isEditMode: false,
      authorSearch: '',
      availableAuthors: [],
      availableCategories: null,
      bookCategoriesIds: [],
    };
  },
  watch: {
    authorSearch() {
      this.loadAuthors();
    },
    book(book) {
      this.authorSearch = book.author.lastName;
      if (book && this.book && this.book.id === book.id) {
        this.isEditMode = false; // post submit, back to show view
      }
      this.computeBookCategoriesIds();
    },
  },
  methods: {
    loadAuthors() {
      http
        .getList('/api/authors', { lastName: this.authorSearch })
        .then((resp) => {
          this.availableAuthors = resp.member;
        });
    },
    computeBookCategoriesIds() {
      if (this.availableCategories === null) {
        http.getList('/api/categories').then((resp) => {
          this.availableCategories = resp.member;
          this.computeBookCategoriesIds();
        });
      } else if (this.book) {
        this.bookCategoriesIds = this.book.categories.map((c) => c['@id']);
      }
    },
    submit() {
      const { book } = this;
      book.author = book.author['@id'];
      book.categories = this.bookCategoriesIds;
      this.$emit('saveBook', book);
    },
  },
};
</script>

<style lang="scss">
#book-detail .icon-top {
  position: absolute;
  top: 0;
  right: 0;
  padding: 1px;
  background: black;
  border-bottom-left-radius: 4px;
  width: 25px;
  height: 25px;
  text-align: center;
  cursor: pointer;
  svg {
    color: white;
  }
}
</style>
