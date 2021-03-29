#/bin/sh
#path="$(pwd)/storage/app/public/article-image"
#path="$(pwd)/storage/app/public/game-image"
path="$(pwd)/storage/app/public/front-img/webp-image"

# jpg
for f in $(find "${path}" -name "*.jpg")
  do
  if [ ! -e "${f}.webp" ]
  then
    cwebp -pass 10 -m 6 -mt -jpeg_like -q 70 $f -o "${f}.webp"
  fi
done
#png
for f in $(find "${path}" -name "*.png")
  do
  if [ ! -e "${f}.webp" ]
  then
    cwebp -q 100 $f -o "${f}.webp"
  fi
done
#jpeg
for f in $(find "${path}" -name "*.jpeg")
  do
  if [ ! -e "'${f}'.webp" ]
  then
    cwebp -pass 10 -m 6 -mt -jpeg_like -q 70 $f -o "'${f}'.webp" &>/dev/null
  fi
done
