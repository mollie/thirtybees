#!/usr/bin/env bash
CWD_BASENAME=${PWD##*/}
CWD_BASEDIR=${PWD}

if [ ! -d "${CWD_BASEDIR}/lib/vendor/" ]; then
  cd lib
  composer install --no-dev --prefer-dist
  composer -o dump-autoload
  find vendor/ -type d -exec cp index.php {} \;
  rm ${CWD_BASEDIR}/lib/vendor/firstred/mollie-api-php/examples -rf
  cd ..
fi

cd ${CWD_BASEDIR}/views/js/app/
if [ ! -d "${CWD_BASEDIR}/views/js/app/node_modules/" ]; then
  npm i
fi
rm -rf ${CWD_BASEDIR}/views/js/app/dist/
NODE_ENV=production webpack --mode production
cp ${CWD_BASEDIR}/views/js/app/index.php ${CWD_BASEDIR}/views/js/app/dist/index.php
cd ${CWD_BASEDIR}

${CWD_BASEDIR}/lib/vendor/firstred/mollie-api-php/.git -rf
${CWD_BASEDIR}/lib/vendor/firstred/mollie-api-php/tests -rf
${CWD_BASEDIR}/lib/vendor/firstred/mollie-api-php/build -rf

FILES=("logo.gif")
FILES+=("logo.png")
FILES+=("LICENSE")
FILES+=("${CWD_BASENAME}.php")
FILES+=("index.php")
FILES+=("controllers/**")
FILES+=("lib/**")
FILES+=("sql/**")
FILES+=("translations/**")
FILES+=("upgrade/**")
FILES+=("views/index.php")
FILES+=("views/css/**")
FILES+=("views/img/**")
FILES+=("views/js/index.php")
FILES+=("views/js/jquery.sortable.js")
FILES+=("views/js/sweetalert-2.1.0.min.js")
FILES+=("views/js/app/index.php")
FILES+=("views/js/app/dist/*.min.js")
FILES+=("views/js/app/dist/index.php")
FILES+=("views/templates/**")

MODULE_VERSION="$(sed -ne "s/\\\$this->version *= *['\"]\([^'\"]*\)['\"] *;.*/\1/p" ${CWD_BASENAME}.php)"
MODULE_VERSION=${MODULE_VERSION//[[:space:]]}
ZIP_FILE="${CWD_BASENAME}/${CWD_BASENAME}-v${MODULE_VERSION}.zip"

echo "Going to zip ${CWD_BASENAME} version ${MODULE_VERSION}"

rm ${ZIP_FILE}
cd ..
for E in "${FILES[@]}"; do
  find ${CWD_BASENAME}/${E}  -type f -exec zip -9 ${ZIP_FILE} {} \;
done
