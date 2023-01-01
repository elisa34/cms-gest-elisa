"use strict";

(function () {
  if (
    document.getElementsByClassName("all-blog-articles").length <= 0 ||
    document.getElementsByClassName("blogposts-list").length <= 0
  ) {
    return;
  }

  var petite_stories_colcade = new Colcade(
    ".add-blog-to-sidebar .all-blog-articles",
    {
      columns: ".petite-stories-colcade-column",
      items: ".posts-entry.blogposts-list",
    }
  );
})();
