Charla Magento 1.x Plugin
=================

Charla Live Chat Plugin adds the necessary scripts for Charla widget to appear on your site. Great Businesses are using Charla Live Chat for their Customer Support and Sales and Lead Generation. Browse to https://getcharla.com for more information.

## Installation in 3 simple steps
1. Download the repository as a zip file.
2. Extract the folder to your testing/production magento 1.x instance.
3. Refresh Magento Cache and Logout then Login.

You're done. Head over to System ➡ Configuration. Click on the Charla Tab and add your Property Id and click Save. Browse to your homepage, you should see now Charla Live Chat widget appearing on your page.

For Magento 2.x, browse to Magento Marketplace and search for Charla Live Chat.

## Know Issues

### Conflict with Prototype.js
Magento 1.x uses an outdated library called Prototype.js http://prototypejs.org/. This library changes the native javascript prototypes to include different helper functions. This approach is now considered a bad practice as it might conflict with any library that is using the native javascript functions. The problems appears when you add Charla Widget and the widget does not show up on your webstore, resulting to the below error in the console:

```
Uncaught TypeError: undefined is not a function
    at Neub.t.exports (widget.js:formatted:2077)
    at t.exports (widget.js:formatted:7717)
    at widget.js:formatted:4371
    at Array.map (widget.js:formatted:1416)
    at Array.toArray (56d5257364377d0bc95405ecc85e5e01.1605770829.jsmin.js:formatted:887)
    at WijE.t.exports (widget.js:formatted:3501)
    at Object.rH3X (widget.js:formatted:7499)
    at i (widget.js:formatted:8273)
    at Module.mRIq (widget.js:formatted:4955)
    at i (widget.js:formatted:8273)
```

To overcome this you need to instruct Prototype to use the conflicting `toArray` native javascript function instead of the ones prototype provide. To do this head over to your magento root directory and down to `js/prototype/prototype.js` and comment this function on line 1001 (when unminified) to be:

```
  /*function toArray() {
    return this.map();
  }*/
```

Next comment the two mappings of `toArray` and `entries` on line 1032:

```
  return {
    each:       each,
    eachSlice:  eachSlice,
    all:        all,
    every:      all,
    any:        any,
    some:       any,
    collect:    collect,
    map:        collect,
    detect:     detect,
    findAll:    findAll,
    select:     findAll,
    filter:     findAll,
    grep:       grep,
    include:    include,
    member:     include,
    inGroupsOf: inGroupsOf,
    inject:     inject,
    invoke:     invoke,
    max:        max,
    min:        min,
    partition:  partition,
    pluck:      pluck,
    reject:     reject,
    sortBy:     sortBy,
    /*toArray:    toArray,*/ <-- commented
    /*entries:    toArray,*/ <-- commented
    zip:        zip,
    size:       size,
    inspect:    inspect,
    find:       detect
  };
})();
```

Now save the file and go to your store and Charla Widget would should up. Now prototype is using the native toArray javascript function and won't impact any other functionality on your magento website.
