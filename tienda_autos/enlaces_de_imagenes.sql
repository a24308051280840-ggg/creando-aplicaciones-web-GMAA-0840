-- ENLACES DE LAS IMÁGENES
-- Pega entre las comillas el enlace DIRECTO de la imagen de cada auto
-- (clic derecho en la foto > Copiar dirección de la imagen).
-- Luego ejecuta este archivo completo en phpMyAdmin (pestaña SQL).
-- Los autos que dejes con '' seguirán usando la foto de la carpeta imagenes (si existe).
USE tienda_autos;

-- Sedanes
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2snqAh9Xe1XB_rP5FdWUlJK2oWUBGtENg6xdZCIqqRg&s' WHERE imagen = 'toyota-corolla'; -- Toyota Corolla
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_Uyg-VI8MH8hyBLNwALiRKNrTAytoxqfyffN78fzjRQ&s=10' WHERE imagen = 'toyota-camry'; -- Toyota Camry
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbSO7L867pNsNtBn1I2HsVse_J1qiPZsIBXcQcsE92pw&s=10' WHERE imagen = 'nissan-versa'; -- Nissan Versa
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSVT4PSwXWpjST19QVTjymOk7IX9Pm07tuEoMGn407SQ&s=10' WHERE imagen = 'nissan-sentra'; -- Nissan Sentra
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjtrs1PClkFFyeHzmH0W6x50BbZG54eqwtTKkmptHGOg&s=10' WHERE imagen = 'nissan-altima'; -- Nissan Altima
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHiqVyFhd34oJErdNw94fOf3_QesJ65L3SU2j8FiPuCg&s=10' WHERE imagen = 'chevrolet-aveo'; -- Chevrolet Aveo
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTztZRCpdzkJIaUGPjfwM8JE0ZeMiFzbvk2oo6OxRjYLg&s=10' WHERE imagen = 'honda-civic'; -- Honda Civic
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTuKxDoAIB0damtgVH80gDaDxsOeUuxf9YkUfbdBx1wwg&s=10' WHERE imagen = 'honda-accord'; -- Honda Accord
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMRhK0tMKd8sRhGyHR1WRkVai-IA37qfi_o_S13mDKYw&s=10' WHERE imagen = 'volkswagen-jetta'; -- Volkswagen Jetta
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQoEo_r0rDNx2-xD3paJcleW9hjL1Tsdh4a4Vn-_dVF9w&s=10' WHERE imagen = 'mazda-mazda-3-sedan'; -- Mazda Mazda 3 Sedán

-- SUV
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS72uVdtGP6bP1K-scqCmaO8dwlgk4TALwDYqak8ZZscw&s=10' WHERE imagen = 'toyota-rav4'; -- Toyota RAV4
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTPC9mu5ei32cqDSi2MElG0gPvfNHYdLCy4arRftsgYA&s=10' WHERE imagen = 'honda-cr-v'; -- Honda CR-V
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAz02jVK5yhJiMRtb_g3ihDxUOsFjkl_eBphehH6fwyA&s=10' WHERE imagen = 'mazda-cx-5'; -- Mazda CX-5
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQr0hZDc1WV2aDp2s-j0wwUc-rji6_jk3WUlhdXeojW-Q&s=10' WHERE imagen = 'nissan-kicks'; -- Nissan Kicks
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMDNLS4sYcb5GhCUM5K-m9Gb7Ftt1C-nKatKSETaZFcg&s=10' WHERE imagen = 'nissan-x-trail'; -- Nissan X-Trail
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR1x2YEMROqY5AwZX1BVQLM7kOrIKRbVW8BR_iHR79DcA&s=10' WHERE imagen = 'chevrolet-tracker'; -- Chevrolet Tracker
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSQXv9_rdlubAZRFrwQxfabB7uc6Bk_YNy9ALpHhdSBw&s=10' WHERE imagen = 'ford-escape'; -- Ford Escape
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVnepLeQRAdtkAXbO2HV9FL8ES-BiVRkn--dcV5fWIcw&s=10' WHERE imagen = 'kia-sportage'; -- Kia Sportage
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTABH4E2kA7B26sIoG6KPOBLk73DPF3NgFV4xeX-cCq7Q&s=10' WHERE imagen = 'hyundai-tucson'; -- Hyundai Tucson
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzYxYLtOIPLugte8ZWwC1UC0wWoYBRyxKjNWwYqQUD1g&s=10' WHERE imagen = 'volkswagen-tiguan'; -- Volkswagen Tiguan

-- Pickups
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTR5ALEGKhkbqR4FUk8aiKS3tWVXN0Rtb1AdM-oc3ChaA&s=10' WHERE imagen = 'toyota-hilux'; -- Toyota Hilux
UPDATE autos SET imagen_url = 'https://acnews.blob.core.windows.net/imgnews/medium/NAZ_27dfcd2d7c364ae182bb42b5c1ce90a9.webp' WHERE imagen = 'toyota-tacoma'; -- Toyota Tacoma
UPDATE autos SET imagen_url = 'https://upload.wikimedia.org/wikipedia/commons/9/94/Nissan_NP300_Navara_DoubleCab.jpg?utm_source=es.wikipedia.org&utm_campaign=index&utm_content=original' WHERE imagen = 'nissan-frontier'; -- Nissan Frontier
UPDATE autos SET imagen_url = 'https://acnews.blob.core.windows.net/imgnews/large/NAZ_456cc432677543e288e9a023776e800f.webp' WHERE imagen = 'ford-ranger'; -- Ford Ranger
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQB8pt_e88OMShYrW-ADgWLYVd77WjN9YPBeBT9sqpnRNXKALpfdEwmHSk&s=10' WHERE imagen = 'ford-f-150'; -- Ford F-150
UPDATE autos SET imagen_url = 'https://www.chevrolet.com/content/dam/chevrolet/na/us/english/index/trucks/2026-silverado-hd/special-edition/2026-slhd-special-01-v2.png?imwidth=1920' WHERE imagen = 'chevrolet-silverado'; -- Chevrolet Silverado
UPDATE autos SET imagen_url = 'https://www.ram.com/content/dam/cross-regional/nafta/ramtrucks/es_mx/2026/ram-1500/galeria/desktop/my26-ram-1500-galeria02-alldevices-mx.jpg.img.1440.jpg' WHERE imagen = 'ram-1500'; -- RAM 1500
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSOxLJSATT5n3m1wXaeoiikiZLJxOyzCj4kZb7UEgQ3HA&s=10' WHERE imagen = 'mitsubishi-l200'; -- Mitsubishi L200
UPDATE autos SET imagen_url = 'https://upload.wikimedia.org/wikipedia/commons/7/7d/VW_Amarok.JPG?utm_source=es.wikipedia.org&utm_campaign=index&utm_content=original' WHERE imagen = 'volkswagen-amarok'; -- Volkswagen Amarok
UPDATE autos SET imagen_url = 'https://www.gmc.com/content/dam/gmc/na/us/english/index/vehicles/2026/trucks/sierra-ld/sle-slt/masthead/my26-sierra-1500-pro-masthead-1280x960-26PGSRLD99227.jpg?imwidth=1920' WHERE imagen = 'gmc-sierra'; -- GMC Sierra

-- Deportivos
UPDATE autos SET imagen_url = 'https://www.gallery-aaldering.com/wp-content/uploads/2025/06/ford-mustang-shelby-gt-500-fastback-1967.jpg' WHERE imagen = 'ford-mustang'; -- Ford Mustang
UPDATE autos SET imagen_url = 'https://upload.wikimedia.org/wikipedia/commons/5/55/2021-Chevrolet-Camaro-RS-convertible-front.jpg?utm_source=es.wikipedia.org&utm_campaign=index&utm_content=original' WHERE imagen = 'chevrolet-camaro'; -- Chevrolet Camaro
UPDATE autos SET imagen_url = 'https://upload.wikimedia.org/wikipedia/commons/f/f8/Dodge_Challenger_RT_%28LC%29_Hemi_Leimershof_-20190907-RM-165850.jpg?utm_source=es.wikipedia.org&utm_campaign=index&utm_content=original' WHERE imagen = 'dodge-challenger'; -- Dodge Challenger
UPDATE autos SET imagen_url = 'https://hips.hearstapps.com/hmg-prod/images/b656d60a-56e4-4704-ad18-a7363bd7ad23.jpg?resize=980:*' WHERE imagen = 'nissan-z'; -- Nissan Z
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfPwvan8-4xXiDU-VKxyp9P1GQPdUvY_kn7MqEukFxI8vROfFjqAHRbZg&s=10' WHERE imagen = 'toyota-gr86'; -- Toyota GR86
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgj1V8n4cJnYvSJ2cdZbbu_PW0jBV5zNvYOajUmfgfPA&s=10' WHERE imagen = 'subaru-brz'; -- Subaru BRZ
UPDATE autos SET imagen_url = 'https://images.seminuevos.com/thumbs/w/orig/static.latamautos.com/2026/10/1-Mazda-MX-5-review-2024.jpg' WHERE imagen = 'mazda-mx-5'; -- Mazda MX-5
UPDATE autos SET imagen_url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSpYAqq5lEyEKwTDP2BaxOO49Q9T9ibfAZWRghFRF-Cbr6IoJSjcBWT9A&s=10' WHERE imagen = 'chevrolet-corvette'; -- Chevrolet Corvette
UPDATE autos SET imagen_url = 'https://upload.wikimedia.org/wikipedia/commons/b/b8/BMW_G87_M2_1X7A1838.jpg?utm_source=en.wikipedia.org&utm_campaign=index&utm_content=original' WHERE imagen = 'bmw-m2'; -- BMW M2
UPDATE autos SET imagen_url = 'https://acnews.blob.core.windows.net/imgnews/large/NAZ_46b583c09b9b42e5b9a59732e650e3e6.jpg' WHERE imagen = 'mini-john-cooper-works'; -- Mini John Cooper Works
