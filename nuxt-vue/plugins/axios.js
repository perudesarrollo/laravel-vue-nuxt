import swal from 'sweetalert'
export default function ({ $axios }) {
  $axios.onError((error) => {
    swal(`${error.response.status}`, `${error.response.statusText}`, 'error')
  })
}
