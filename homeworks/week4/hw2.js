const request = require('request');

const process = require('process');

const action = process.argv[2];
const params = process.argv[3];
const newName = process.argv[4];

function listBook() {
  request('https://lidemy-book-store.herokuapp.com/books?_limit=20',
    (err, res, body) => {
      if (err) {
        console.log('Fail', err);
      }
      const books = JSON.parse(body);
      for (let i = 0; i < books.length; i += 1) {
        console.log(`${books[i].id} ${books[i].name}`);
      }
    });
}

function readBook(id) {
  request(`https://lidemy-book-store.herokuapp.com/books/${id}`,
    (err, res, body) => {
      if (err) {
        return console.log('Fail', err);
      }
      const books = JSON.parse(body);
      return console.log(books.id, books.name);
    });
}

function deleteBook(id) {
  request.delete(`https://lidemy-book-store.herokuapp.com/books/${id}`,
    (err) => {
      if (err) {
        return console.log('Fail', err);
      }
      return console.log(`已刪除 id為 ${id} 的書本`);
    });
}

function createBook(name) {
  request.post({
    url: 'https://lidemy-book-store.herokuapp.com/books',
    form: {
      name,
    },
  },
  (err) => {
    if (err) {
      return console.log('Fail', err);
    }
    return console.log(`Create a new book : ${name}`);
  });
}

function updateBook(id, name) {
  request.patch({
    url: `https://lidemy-book-store.herokuapp.com/books/${id}`,
    form: {
      name,
    },
  },
  (err) => {
    if (err) {
      return console.log('Fail', err);
    }
    return console.log(`Update ID : ${id} book name to ${name}`);
  });
}

if (action === 'list') { listBook(); }
if (action === 'read') { readBook(params); }
if (action === 'delete') { deleteBook(params); }
if (action === 'create') { createBook(params); }
if (action === 'update') { updateBook(params, newName); }
