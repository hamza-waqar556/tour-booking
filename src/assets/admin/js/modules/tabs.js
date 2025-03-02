class TabSwitcher {
  constructor() {
    this.$tabs = $("ul.nav-tabs > li");
    this.bindEvents();
  }

  bindEvents() {
    this.$tabs.on("click", (e) => {
      e.preventDefault();
      this.switchTab(e);
    });
  }

  switchTab(e) {
    // Remove 'active' class from currently active tab and pane
    $("ul.nav-tabs li.active").removeClass("active");
    $(".tab-pane.active").removeClass("active");

    // Determine which tab and pane to activate
    const $clickedTab = $(e.currentTarget);
    const activePaneID = $(e.target).attr("href");

    // Add 'active' class to the clicked tab and corresponding pane
    $clickedTab.addClass("active");
    $(activePaneID).addClass("active");
  }
}

jQuery(document).ready(() => {
  new TabSwitcher();
});

export default TabSwitcher;
