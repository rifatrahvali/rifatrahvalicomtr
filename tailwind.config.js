/** @type {import('tailwindcss').Config} */
export default {
  // Tailwind'in hangi dosyalarda class arayacağını belirtir.
  // Bu sayede kullanılmayan stiller derlenmiş CSS dosyasından çıkarılır.
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  // Projenize özel renkler, fontlar gibi temaları genişletmek için kullanılır.
  theme: {
    extend: {},
  },
  // Projeye ek Tailwind eklentilerini (plugin) tanımlar.
  plugins: [],
}
